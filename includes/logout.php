<?php

session_start();
// $_SESSION['alertFail'] = "All session destroy";
session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>