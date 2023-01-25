<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('CREATED', 101);
define('SUCCESS', 101);
define('EXISTS', 102);
define('FAILURE', 103);
define('AUTHENTICATED', 201);
define('NOT_FOUND', 202);
define('PASSWORD_DO_NOT_MATCH', 203);
define('ENABLE_RTL_MODE', 'false');

// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://'.$_SERVER['SERVER_NAME'].'/ALG/');

define ('SITE_ROOT', realpath(dirname(__FILE__)));

define('LIBS', 'libs/');

define('MAILER_DIR', 'libs/PHPMailer/vendor/phpmailer/phpmailer/src/');