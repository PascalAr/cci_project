<?php 
session_start(); 

if(array_key_exists('username', $_SESSION)){

include '../../class/Autoloader.php'; 
Autoloader::register();
$database = new Database(); 

$vew = 'backhome.phtml';
$title = 'Back office';

$login_user = $_SESSION['username'];

include '../tpl/backtemplate.phtml';

} else {
    echo 'Error'; 
}