<?php
session_start();
define('ROOT', __DIR__);
ini_set('xdebug.var_display_max_depth', '10');
ini_set( 'error_reporting', E_ALL );

require 'functions/user.php';

// CLASSES
require 'classes/UserValidate.php';
require 'classes/Database.php';
require 'classes/User.php';

