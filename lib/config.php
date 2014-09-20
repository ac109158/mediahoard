<?php

//setup helper functions

define('SITENAME', 'MEDIA');
define('SLOGAN', '...Dynamic Web Development');
define('BASE_URL', ($_SERVER['DOCUMENT_ROOT']).'/cs4000');
define('URL', 'http://andy.plusonedevelopment.com/cs4000');
define('CONTROLLER', './components/controllers/');
define('MODEL', './components/models/');
define('VIEW', './components/views/');
define('HEADER', './components/views/header/');
define('FOOTER', './components/views/footer/');

define('LIB', './lib/');
define('SCRIPT', './scripts/');
define('CSS', './css/');
define('BOOTSTRAP', './css/bootstrap/');
define('JS', './js/');

$date = date("l  F j, o");define('DATE', "$date");



define('DB_TYPE', 'mysql');
define('DB_HOST', 'mysql.cs.dixie.edu');
define('DB_NAME', 'acook');
define('DB_USER', 'acook');
define('DB_PASS', 'Victory83');

define('STYLE', CSS.'style.css');

define('RAND_KEY', '8iQc5oik66oVZe6'); // DO NOT CHANGE
define('SALT', '8iQc5oik66oVZe6'); // DO NOT CHANGE


define('LOGIN_ATTEMPTS',  '6'); // Number of attempts before lockout


