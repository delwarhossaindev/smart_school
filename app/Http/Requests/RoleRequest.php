<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', Rule::unique('roles', 'name')->ignore($this->route('role'))],
            'note' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return ['name.unique' => __('already_exist')];
    }
}
