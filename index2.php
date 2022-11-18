<?php
session_start();

include 'logic.php';

$username =  $_SESSION['user']['username'];
$avatar = $_SESSION['user']['avatar'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab2-Mini Chat</title>
    <link rel="stylesheet" href="./style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<h1 id="title" class="display-5">Mini-Chat</h1>
<div class="top">
    <!--Display Welcome Message Using session and return avatar -->
        <form id="form" method="post" action="logic.php">
            <?php echo "<h2 id='h2'>Welcome "."<p id='test'>$username</p></h2>" ?>
            <img id="user-pic" src="<?php echo './uploads/'.$avatar ?>">
            <button name="logout" type="submit" class="btn btn-warning" style="width: 100%;">Log Out</button>
        </form>
</div>

<!-- Form to send messages-->
<div class="mid">
    <div class="box-left">
        <h2>Send A Message</h2><br>
        <form method="post" action="logic.php">
                <div class="mb-3">
                    <textarea name="postComment" class="form-control" id="sendMsg" rows="8"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button name="sendMsg" type="submit" class="btn btn-primary btn-sm" style="padding: 5px 30px 5px 30px;">Send</button>
                </div>
        </form>
    </div>
    <div class="box-right">
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