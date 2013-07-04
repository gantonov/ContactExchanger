<?php
define('_ROOT_DIR_', realpath(dirname(__FILE__).'/..').'/');
define('_CLASSES_DIR_', _ROOT_DIR_ . 'classes/');
define('_CONTROLLERS_DIR_', _ROOT_DIR_ . 'controllers/');
define('SMARTY_DIR', _ROOT_DIR_."libs/Smarty/");

define('_DB_SERVER_','localhost');
define('_DB_USERNAME_','root');
define('_DB_PASSWORD_','');
define('_DB_','contact-exchanger');
define('_DB_PREFIX_','ce_');

define('_ROOT_URL_','http://localhost/ContactExchanger/');

/**#@+
 *  Permissions flag 
 */
define('CAN_ADD',1);
define('CAN_EDIT',2);
define('CAN_SEE_OTHERS',4);
define('CAN_SHARE',8);
define('CAN_DELETE',16);
/**#@-*/