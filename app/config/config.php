<?php

// DB Params
define('DB_HOST', 'db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'test');

define('APPROOT', dirname(dirname(__FILE__))); // ✅ For filesystem paths
define('URLROOT', 'http://localhost:8000');    // ✅ For browser URLs

// Define SITENAME
define('SITENAME', 'Library');


define('Admin', 1);
define('user', 2);
define('teacher', 3);
