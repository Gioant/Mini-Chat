<?php
//to establish connection to db
$username = 'root';
$dsn = 'mysql:host=localhost; dbname=lab2mod4';
$password = '';

try {
    //create an instance of the PDO class with the required parameters
    $db = new PDO($dsn, $username, $password);

    //set pdo error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $ex) {
    //display error message
    echo "Connection failed " . $ex->getMessage();
}

