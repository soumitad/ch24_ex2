<?php
// Set up the database connection
$dsn = 'mysql:host=sql.njit.edu;dbname=sd655';
    $username = 'sd655';
    $password = 'pSLU9F3d';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('errors/db_error_connect.php');
    exit();
}
?>
