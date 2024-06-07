<?php

function setCookieUser($email, $username, $password)
{
    $cookieValue = ["email"=>$email, "username"=>$username, "password"=>$password];
    setcookie("LogIn", json_encode($cookieValue), time() + (86400 * 30), "/");
    $_SESSION["LogIn"] = $cookieValue;
}