<?php

include_once "./includes/dbConnect.php";


//if user pressed register
if (isset($_POST['register'])) {
    //trim and save form inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);
    $confirmPwd = trim($_POST['confirmPwd']);
    $avatar = $_POST['uploadAvatar'];

    //include file here for functions that we created inside the file
    require_once './includes/functions.inc.php';

    //validate if passwords match
    if (pwdMatch($password, $confirmPwd) !== false) {
        header("location: ./register.php?error=pwdsDontMatch");
        exit();
    }


    //before register user check to see if username is already in db
    //boolean variable to be used as a checker
    $userTaken = false;

    //create php associative array using form inputs as values
    $usernameCheck = array(
        "username" => $_POST['username']);

    //query to select all usernames from users table
    $query = $db->prepare("SELECT * FROM users WHERE username = :username");

    //execute Query Statement using username from register form
    $query->execute($usernameCheck);

    //if the statement returns a username from table
    if ($row = $query->fetch()) {
        //it means username is already taken so return true
        $userTaken = true;
    } else {
        // else return false
        $userTaken = false;
    }

    //if the function returns true
    if (!$userTaken) {
        //create php associative array using form inputs as values
        $registerUser = array(
            "username" => $_POST['username'],
            "password" => md5($_POST['pwd']),
            "avatar" => basename($_FILES['uploadAvatar']['name']));

        //query to add into database
        $query = $db->prepare("INSERT INTO users (username, password, avatar)VALUES(:username,:password,:avatar);");

        //execute query using array of form inputs
        $query->execute($registerUser);

        //check if one new row was created to database
        if ($query->rowCount() == 1) {
            //when user register save picture to folder
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["uploadAvatar"]["name"]);

            //function to move picture
            move_uploaded_file($_FILES["uploadAvatar"]["tmp_name"], $target_file);

            //redirect user to main page
            header('location: index.php?registerSuccess');
            exit();
        } else {
            echo '<script>alert("Register Failed!")</script>';
        }

        //else function returned false and that means username is in db already
    } else {
        header('location: register.php?error=UsernameTaken');
        exit();
    }
}


if(isset($_POST['login'])){
        $query = $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");
        $query->execute(array(
            "username" => $_POST['userLogin'],
            "password" => md5($_POST['userPwd']),
        ));


        $data = $query->fetch(PDO::FETCH_ASSOC);

        //if condition to check from query that it returns a result
        if ($data) {
            //must start session
            session_start();
            $_SESSION['user'] = $data;
            header("location: index2.php");
        } else {
            header("location: index.php?error=loginFailed");
            exit();
        }

}

if(isset($_POST['sendMsg'])){
    session_start();
        $newComment = array(
            "username" => $_SESSION['user']['username'],
            "avatar"=> $_SESSION['user']['avatar'],
            'comment' => $_POST['postComment']);



        //query to add into database
        $query = $db->prepare( "INSERT INTO posts (username,avatar,comment) VALUES (:username,:avatar,:comment);");
        $query->execute($newComment);


        header("Location: index2.php?status=Sent");

}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();

    header("location: index.php");
}