<?php 
session_start(); 

include '../class/Autoloader.php'; 
Autoloader::register();

$username = htmlspecialchars($_POST['username']); 
$password = htmlspecialchars($_POST['password']); 

$database = new Database(); 
$log = $database->queryOne('SELECT * FROM admin'); 
var_dump($log['password']);

$password_verif = password_verify($password, $log['password']); 



/**
 * Si le mot de passe est correct ( password_verify )
 */
if($password_verif === true){
/**
 *  J'enregistre le nom de l'utilisateur dans la variable SESSION.
 */
$_SESSION['username'] = $username; 


header('Location: controller/backhome.php'); 

} else {

$_SESSION['error_log'] = "Le mot de passe ou le nom utilisateur semblent incorrects";
header('Location: index.php');

}

