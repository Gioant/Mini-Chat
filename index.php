<?php
include 'logic.php';

//if (!isset($_SESSION)) session_start();

session_start();

$username =  @$_SESSION['user']['username'];
$avatar = @$_SESSION['user']['avatar'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab2-Mini Chat</title>
    <link rel="stylesheet" href="./style1.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<?php
if (isset($_GET["registerSuccess"])) {
    echo "<script>Swal.fire({
    title: 'Success!',
    text: 'User Registered Successfully!',
    icon: 'success',
    confirmButtonText: 'Thank You'
})</script>";
}
?>

<h1 id="title" class="display-5">Mini-Chat</h1>
    <div class="top">
        <form class="mt-2" method="post" action="logic.php">
            <!-- Grid row -->
            <div class="form-group row m-2">
                <!-- Default input -->
                <label for="userLogin" class="col-sm-3 col-form-label" style="font-size: 18px; color: black;">Username</label>
                <div class="col-auto">
                    <input type="text" class="form-control" id="userLogin" placeholder="Enter Username" name="userLogin">
                </div>
            </div>
            <!-- Grid row -->

            <!-- Grid row -->
            <div class="form-group row m-2">
                <!-- Default input -->
                <label for="UserPwd" class="col-sm-3 col-form-label" style="font-size: 18px; color: black;">Password</label>
                <div class="col-auto">
                    <input type="password" class="form-control" name="userPwd" id="UserPwd" placeholder="Enter Password">
                </div>
            </div>
            <!-- Grid row -->
            <div id="login">
                <button type="submit" class="btn btn-primary btn-sm" name="login" style="padding: 5px 30px 5px 30px;">Login</button>
            </div>
        </form>
        <div id="register">
            <a href="./register.php">
            <button class="btn btn-primary btn-sm" name="register1" style="padding: 5px 30px 5px 30px;">Register</button>
            </a>
        </div>


        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "loginFailed") {
                echo ' <div id="red" class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 20px; margin-right: 10px;"></i>
                <strong style="margin-right: 10px;">Danger!</strong> Login Failed... please Try again!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </button>
            </div>';
            }
        }
        ?>
    </div>


    <div class="mid">
        <div class="box-left">
            <h2>Send A Message</h2><br>
            <form method="post" action="">
                <fieldset disabled>
            <div class="mb-3">
                <textarea class="form-control" id="sendMsg" rows="7"></textarea>
            </div>
                <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm" style="padding: 5px 30px 5px 30px;">Send</button>
                </div>
                </fieldset>
            </form>
        </div>

        <!-- Message From Db Div -->
        <div class="box-right">
            <!-- must echo in php -->
            <h2>Messages From Database</h2>
            <?php
            //query to prepare and execute a mysql statement to get users comment from table posts
            $query = $db->prepare("SELECT * FROM posts ORDER BY Id DESC");
            $query->execute();

            //get everything from posts table
            $posts = $query->fetchAll(PDO::FETCH_ASSOC);


            //we must loop through each row of table
            foreach($posts as $person) {
                //save picture of user inside a variable
                $imgsrc = 'uploads/' . $person['avatar'];

                //if condition to check length of post is less than 80
                if(strlen($person['comment']) <= 80) {
                    echo '<div class="msgContainer">
            <p class="posts"><img class="avatar" src="uploads/' . $person['avatar'] . '"> <b>' . $person['username'] . '</b> 
            <p>'. $person['comment'] . '</p> 
            </p>
            <hr>
            </div>';
                } else {
                    //else use wordwrap function to echo a new line after a certain length
                    $test = wordwrap($person['comment'], 90,"<br>\n",true);

                    echo '<div class="msgContainer">
            <p class="posts"><img class="avatar" src="uploads/' . $person['avatar'] . '"> <b>' . $person['username'] . '</b> 
            <p>'. $test . '</p> 
            <hr>
                        </div>';
                }
            }

            ?>
            </div>
        </div>




</body>
</html>