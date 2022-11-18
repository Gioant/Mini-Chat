<?php
//function to verify if both passwords are the same
function pwdMatch($pwd, $confirmPwd)
{
    $result;
    if ($pwd !== $confirmPwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

