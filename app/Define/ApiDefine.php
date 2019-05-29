<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 6/22/2017
 * Time: 11:28 AM
 */
define('CODE_SUCCESS', 200);
define('CODE_DELETE_OK', 204);
define('CODE_BAD_REQUEST', 400);
define('CODE_UNAUTHORIZED', 401);
define('CODE_PAYMENT_REQUIRED', 402);
define('CODE_FORBIDDEN', 403);
define('CODE_NOT_FOUND', 404);
define('CODE_INTERNAL_SERVER_ERROR', 500);
define('CODE_NOT_IMPLEMENTED', 501);

define('MSG_SUCCESS', 'OK');
define('MSG_DELETE_OK', 'Delete OK');
define('MSG_BAD_REQUEST', 'Bad Request');
define('MSG_UNAUTHORIZED', 'Unauthorized');
define('MSG_PAYMENT_REQUIRED', 'Payment Required');
define('MSG_FORBIDDEN', 'Forbidden');
define('MSG_NOT_FOUND', 'Not Found');
define('MSG_INTERNAL_SERVER_ERROR', 'Internal Server Error');
define('MSG_NOT_IMPLEMENTED', 'Not Implemented');

define('STATUS_ENABLE', 1);
//log User
define('LOG_USER_TO_TRANFER', 'LOG_USER_TO_TRANFER');

// Storage Path
define('STORAGE_PATH', 'app' . DIRECTORY_SEPARATOR . 'public');

?>