<?php 

ob_start();

session_start();
// session_destroy();

defined('DS') ? null : define('DS','DIRECTORY_SEPARATOR');

defined('TEMPLATE_BACK') ? null : define('TEMPLATE_BACK', __DIR__ . DS . 'templates/back');

defined('TEMPLATE_FRONT') ? null : define('TEMPLATE_FRONT', __DIR__ . DS . 'templates/front');

defined('DB_HOST') ? null : define('DB_HOST','localhost');

defined('DB_USER') ? null : define('DB_USER','root');

defined('DB_PASS') ? null : define('DB_PASS', '');

defined('DB_NAME') ? null : define('DB_NAME','ecom_db');

require_once('functions.php');

// $query = "CREATE DATABASE ecommerce_db";



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS);

mysqli_query($connection,"CREATE DATABASE IF NOT EXISTS ecommerce");

creating_categories_table();
creating_products_table();
creating_order_table();

creating_report_table();
creating_users_table();


 ?>