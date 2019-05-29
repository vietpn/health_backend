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

//mạc định khi tìm kiếm số point phải lớn hơn 180

define('POINT_DEFAULT', 180);
define('LIMIT', 15);
define('BUY_ITEM', 1);//mua item
define('SEARCH', 2);//tìm kiếm profile mất 180 point
define('CHAT', 3);//mỗi lần chat mất 10point
define('GIVE_POINT', 4);//tặng point trừ point
define('PLUS_POINT_CHAT', 5);//cộng 5 point khi được reply
define('PLUS_CARD_IAP_ANDROID',6); //nạp thẻ iap amdroid
define('PLUS_CARD_IAP_IOS', 7);//nạp thẻ iap ios
define('PLUS_POINT_WHEN_GIVE',8 );//được tặng point
define('BUY_PIN',9 );//Mua Pin
//end mạc định tìm


define('CARD_IAP_ANDROID', 1);
define('CARD_IAP_IOS', 2);
//define('');
define('CHAT_POINT', 10);
//define('SORT_DESC', 'desc');
//define('SORT_ASC', 'asc');
define('PLUS_POINT', 1);//cộng point
define('DEDUCTION_POINT', 2);//trừ point

define('STATUS_ENABLE', 1);
//log User
define('LOG_USER_TO_TRANFER', 'LOG_USER_TO_TRANFER');

// Storage Path
define('STORAGE_PATH', 'app' . DIRECTORY_SEPARATOR . 'public');

//define avatar
define('MEN', '/avatar/boy.png');
define('WOMENT', '/avatar/girl.png');
define('AVATAR_MEN', '/avatar/avatar_men.png');
define('AVATAR_WOMENT', '/avatar/avatar_woment.png');
define('SHOP', '/avatar/online-store.png');
define('NUMBER_ACCOUNT_ID', 10000000);//fix số number account id
//delete
define('DELETE', 1);//dã xóa
define('NOT_DELETE', 0);//chưa xóa
define('PROFILE_BUSSINESS', 1);//tài khoản doanh nghiệp
define('DELETE_PROFILE', 1);//xóa tài khoản
define('PROFILE_DEFAULT', 0);//tài khoản thường
// Time expire reset password (seconds)
define('PASSWORD_RESET_EXPIRE', 60 * 5);
define('ENABLE', 1);
define('DISABLE', 0);

define('DEDUCTION_POINT_CHAT', 10);//trừ 10 point khi chat
define('REPLY', 1);//trả lời lại tin nhắn

define('STATUS_DELETED', 1);
define('STATUS_NONE_DELETED', 0);

?>