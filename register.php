<?php

include 'logic.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab2-Mini Chat</title>
    <link rel="stylesheet" href="./style3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="main">
    <h1>Registration Form</h1>
    <hr>
<form class="requires-validation" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="userRegister">Username</label>
        <input type="text" class="form-control" id="userRegister"  name="username" placeholder="Username"  minlength="3" maxlength="15" required/>
    </div>
    <div class="mb-3">
        <label class="form-label" for="passRegister">Password</label>
        <input type="password" class="form-control" id="passRegister" name="pwd" placeholder="Password" minlength="5" required/>
    </div>
    <div class="mb-3">
        <label class="form-label" for="confirm-Pass">Confirm Password</label>
        <input type="password" class="form-control" id="confirm-Pass" name="confirmPwd" placeholder="Password" minlength="5" required/>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Avatar upload</label>
        <input class="form-control" type="file" id="formFile" name="uploadAvatar" accept="image/*" required>
    </div>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "pwdsDontMatch") {
            echo ' <div id="red" class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 20px; margin-right: 10px;"></i>
                <strong style="margin-right: 10px;">Danger!</strong>Passwords Do Not Match!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </button>
            </div>';
        } else if ($_GET["error"] == "UsernameTaken") {
            echo '<div id="red" class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 20px; margin-right: 10px;"></i>
                <strong style="margin-right: 10px;">Danger!</strong>Username Already Taken
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </button>
            </div>';
        }
    }

    ?>
    <div class="modal-footer d-block">
        <button id="submitRegister" type="submit" class="btn btn-success float-end" name="register">Register</button>
        <button id="reset" type="reset" class="btn btn-primary float-end">Reset</button>
    </div>
</form>
</div>
</body>
</html>