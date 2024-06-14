<?php
include 'config.php';
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location:".ROOT_PATH."/login.php");
}
