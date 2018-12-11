<?php 

include '../../class/Autoloader.php'; 

Autoloader::register();

$database = new Database(); 


$vew = 'backhome.phtml';
$title = 'Back office';

include '../tpl/backtemplate.phtml';