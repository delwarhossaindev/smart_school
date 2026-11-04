<?php

namespace App\Legacy;

use App\Legacy\Database\Builder;
use Illuminate\Http\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Runs one migrated controller action the way the CodeIgniter front controller did:
 * builds the shared services, buffers output, and turns the result into a response.
 */
class Runtime
{
    public static array $services = [];

    private static int $bufferBase = 0;

    private static bool $booted = false;

    public static function boot(): void
    {
        if (self::$booted) {
            return;
        }
        self::$booted = true;

        // Legacy code reads and writes relative paths such as ./assets/uploads/.
        chdir(public_path());

        // Same level as CodeIgniter's production mode. Laravel would otherwise turn every
        // undefined index in the legacy code into a fatal exception.
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_USER_NOTICE & ~E_USER_DEPRECATED);

        $baseUrl = rtrim(request()->getSchemeAndHttpHost().request()->getBasePath(), '/').'/';

        defined('ASSET_URL') || define('ASSET_URL', $baseUrl.'assets/');
        defined('VENDOR_URL') || define('VENDOR_URL', $baseUrl.'assets/vendors/');
        defined('CSS_URL') || define('CSS_URL', $baseUrl.'assets/css/');
        defined('JS_URL') || define('JS_URL', $baseUrl.'assets/js/');
        defined('IMG_URL') || define('IMG_URL', $baseUrl.'assets/images/');
        defined('UPLOAD_PATH') || define('UPLOAD_PATH', $baseUrl.'assets/uploads/');

        self::cleanGlobals();

        self::$services = [
            'config' => new Config($baseUrl),
            'lang' => new Lang(),
            'input' => new Input(),
            'uri' => new Uri(),
            'output' => new Output(),
            'session' => new Session(),
            'security' => new Security(),
            'db' => new Builder(),
            'load' => new Loader(),
        ];
    }

    public static function run(string $class, string $method, array $args, ?string $module, string $classSlug): Response
    {
        self::boot();

        self::$services['router'] = new Router($module, $classSlug, $method);

        self::$bufferBase = ob_get_level();
        ob_start();

        try {
            $controller = new $class();
            $controller->{$method}(...$args);

            // As in CodeIgniter, direct echoes come before the buffered view output.
            $body = self::collectBuffers().$controller->output->get_output();

            return self::buildResponse($body);
        } catch (Halt $halt) {
            self::collectBuffers();

            return $halt->response ?? self::buildResponse($halt->body);
        } catch (Throwable $e) {
            self::collectBuffers();

            throw $e;
        }
    }

    /**
     * Called by ci_exit(): gathers everything echoed so far, as PHP would flush it on exit.
     * This has to happen before the throw, because the view engine discards its own buffers.
     */
    public static function halt(string $tail = ''): Halt
    {
        return new Halt(self::collectBuffers().$tail);
    }

    private static function collectBuffers(): string
    {
        $body = '';

        while (ob_get_level() > self::$bufferBase) {
            $body = ob_get_clean().$body;
        }

        return $body;
    }

    /**
     * Moves headers set with PHP's header() onto the response. Symfony would otherwise
     * overwrite them, for example the Content-Type of a JSON or file response.
     */
    private static function buildResponse(string $body): Response
    {
        $status = http_response_code();
        $response = new IlluminateResponse($body, is_int($status) ? $status : 200);

        foreach (headers_list() as $header) {
            [$name, $value] = array_map('trim', explode(':', $header, 2)) + [1 => ''];

            if (strcasecmp($name, 'X-Powered-By') !== 0) {
                $response->headers->set($name, $value, strcasecmp($name, 'Set-Cookie') !== 0);
            }
        }

        if (! headers_sent()) {
            header_remove();
        }

        return $response;
    }

    /**
     * Port of CI_Input::_sanitize_globals(), which every legacy request passed through.
     */
    private static function cleanGlobals(): void
    {
        $clean = function (&$value) use (&$clean) {
            if (is_array($value)) {
                foreach ($value as &$item) {
                    $clean($item);
                }
            } elseif (is_string($value)) {
                $value = remove_invisible_characters($value, false);
            }
        };

        $clean($_GET);
        $clean($_POST);
    }
}
