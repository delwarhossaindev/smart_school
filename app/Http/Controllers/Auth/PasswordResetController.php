<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetLink;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class PasswordResetController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['username' => ['required', 'string']]);

        $user = User::where(['username' => $request->input('username'), 'status' => 1])->first();

        if (! $user) {
            return back()->with('error', __('wrong_username'));
        }

        $email = $user->profile()->email ?? null;

        if (! $email) {
            return back()->with('error', __('unexpected_error'));
        }

        $token = Str::random(60);
        $user->forceFill(['reset_key' => hash('sha256', $token)])->save();

        try {
            [$mailer, $fromAddress, $fromName] = $this->mailerFor($user);

            $mailer->to($email)->send(new PasswordResetLink(route('password.reset', $token), $fromAddress, $fromName));
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', __('unexpected_error'));
        }

        return back()->with('success', __('email_send_success').'. Please check your email inbox or spam folder.');
    }

    public function edit(string $token): View|RedirectResponse
    {
        if (! $this->userForToken($token)) {
            return redirect()->route('login')->with('error', __('unexpected_error'));
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5'],
            'conf_password' => ['required', 'same:password'],
        ]);

        $user = $this->userForToken($request->input('token'));

        if (! $user) {
            return redirect()->route('login')->with('error', __('unexpected_error'));
        }

        $user->forceFill([
            'password' => Hash::make($request->input('password')),
            'temp_password' => null,
            'reset_key' => null,
        ])->save();

        return redirect()->route('login')->with('success', __('update_success'));
    }

    private function userForToken(string $token): ?User
    {
        return User::where('reset_key', hash('sha256', $token))->first();
    }

    /**
     * The branch's own email settings if it has any, otherwise the application's mailer.
     */
    private function mailerFor(User $user): array
    {
        $settings = DB::table('email_settings')->where(['status' => 1, 'branch_id' => $user->branch_id ?: 0])->first();
        $school = $user->branch_id ? DB::table('schools')->where(['status' => 1, 'id' => $user->branch_id])->first() : null;

        $fromAddress = $settings->from_address ?? $school->email ?? config('mail.from.address');
        $fromName = $settings->from_name ?? $school->branch_name ?? config('mail.from.name');

        if (($settings->mail_protocol ?? null) === 'smtp') {
            config(['mail.mailers.branch' => [
                'transport' => 'smtp',
                'host' => $settings->smtp_host,
                'port' => $settings->smtp_port,
                'encryption' => $settings->smtp_crypto ?: 'tls',
                'username' => $settings->smtp_user,
                'password' => $settings->smtp_pass,
                'timeout' => 5,
            ]]);

            return [Mail::mailer('branch'), $fromAddress, $fromName];
        }

        return [Mail::mailer(), $fromAddress, $fromName];
    }
}
