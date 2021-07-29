<?php 

// Database parameters
$cleardb_url = parse_url(getenv('CLEARDB_DATABASE_URL'));
define('DB_HOST', $cleardb_url['host']);
define('DB_USER', $cleardb_url['user']);
define('DB_PASS', $cleardb_url['pass']);
define('DB_NAME', substr($cleardb_url["path"],1));

// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'ehms');

// APPROOT
define('APPROOT', dirname(dirname(__FILE__)));

// URLROOT (dynamic links)
define('URLROOT', 'https://enigmatic-gorge-98470.herokuapp.com');
// define('URLROOT', 'https://localhost/ehms/');

// SITENAME
define('SITENAME', 'Nile University E-Hostel Management System');

?>