<?php
// functions.php


function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function is_admin()
{
    return is_logged_in() && $_SESSION['role'] === 'admin';
}
?>

