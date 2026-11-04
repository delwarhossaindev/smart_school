<?php

// Constants from the CodeIgniter config. The URL constants depend on the request and
// are defined in App\Legacy\Runtime::boot().

defined('FILE_READ_MODE') || define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') || define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') || define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') || define('DIR_WRITE_MODE', 0755);
defined('FOPEN_READ') || define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') || define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') || define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') || define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
defined('FOPEN_WRITE_CREATE') || define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') || define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') || define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') || define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

defined('UTF8_ENABLED') || define('UTF8_ENABLED', true);
defined('MB_ENABLED') || define('MB_ENABLED', extension_loaded('mbstring'));
defined('ICONV_ENABLED') || define('ICONV_ENABLED', extension_loaded('iconv'));

define('IS_LIVE', false);

/* role static id */
define('SUPER_ADMIN', '1');
define('ADMIN', '2');
define('GUARDIAN', '3');
define('STUDENT', '4');
define('TEACHER', '5');
define('ACCOUNTANT', '6');
define('LIBRARIN', '7');
define('RECEPTIONIST', '8');
define('STAFF', '9');

/* Permission */
define('ADD', '0');
define('EDIT', '1');
define('VIEW', '2');
define('DELETE', '3');

define('FROM_EMAIL', 'info@gmbsms.com');
define('FROM_NAME', 'Global Multi Branch School');
