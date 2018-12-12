<?php 
session_start(); 

try{

if(array_key_exists('username', $_SESSION)){

include '../../class/Autoloader.php'; 
Autoloader::register();

$database = new Database(); 

$vew = 'add_faq.phtml';
$title = 'Ajouter une question à la FAQ';

include '../tpl/backtemplate.phtml';

/**
 * Add_FAQ 
 */

 if(array_key_exists('question', $_POST) && array_key_exists('response', $_POST)){

    $errors = [];

    $question = htmlspecialchars($_POST['question']); 
    $response = htmlspecialchars($_POST['response']); 

    if(empty($question) || empty($response)){
        array_push($errors, "Les champs doivent être remplis !"); 
    }

    var_dump($errors);

    if(empty($errors)){
        
        echo 'Victoire';
            /* Request Qui Marche !
            /*
            $sth = $database::$pdo->prepare('INSERT INTO faq VALUE(null, :question, :response)');
            $sth->execute(array(
            ':question' => $question,
            ':response' => $response,
            ));
            */

    }else{

        $_SESSION['error'] = $errors;
        
        header('Location: add_faq.php');

    }



 }



} else {
    Header('Location: ../index.php');
}

}catch(PDOException $e){
    echo $e->getMessage();
}
