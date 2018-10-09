<?php 
session_start();
if (isset($_SESSION)){
    session_regenerate_id(true);
    session_destroy();
}
if (isset($_GET["time"])){
    header('Location: index.php?time=true');
}elseif (isset($_GET["failure"])) {
    header('Location: index.php?denied=true');
} else {
    header('Location: index.php');
}