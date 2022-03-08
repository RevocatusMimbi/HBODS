<?php 
// DB credentials.
define('DB_HOST','bbdad5ioqwd0sewjfosg-mysql.services.clever-cloud.com');
define('DB_USER','urpd0jr1bfydg7wu');
define('DB_PASS','DYEdU3PBHjtSZk1a9Uq6');
define('DB_NAME','bbdad5ioqwd0sewjfosg');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$con = mysqli_connect("DB_HOST","DB_USER", "DB_PASS", "DB_NAME");
?>