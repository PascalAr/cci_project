<?php 
session_start(); 

try{

    if(array_key_exists('username', $_SESSION)){

        include '../../class/Autoloader.php'; 
        Autoloader::register();
        $database = new Database(); 
        
        $vew = 'reset_password.phtml';
        $title = 'reset password';
        
        $login_user = $_SESSION['username'];
        
        include '../tpl/backtemplate.phtml';
        
        /**
         * Ré-initialisation du mot de passe 
         */
        if(array_key_exists('reset_password', $_POST)){
        
            $errors = []; 
            
            $reset_pass = htmlspecialchars($_POST['reset_password']); 
            $confirm_reset_pass = htmlspecialchars($_POST['confirm_reset_password']);
        
            if($reset_pass !== $confirm_reset_pass){
                array_push($errors, "Confirmation non valide"); 
            } 
        
            if(empty($reset_pass) || empty($confirm_reset_pass)){
                array_push($errors, "Les champs doivent être remplis");
            }
            
            /**
             * Si il n'y à pas d'erreur ( le tableaux $errors est vide ) :
             */
            if(empty($errors)){
        
                $pass_hash = password_hash($reset_pass, PASSWORD_DEFAULT);
                //$pass_hash = $reset_pass;
                var_dump($pass_hash);
                $sth = $database::$pdo->prepare("UPDATE admin 
                                                 SET password = :passhash
                                                 WHERE username = :username");
                $sth->execute(array(
                    ':passhash' => $pass_hash,
                    ':username' => $_SESSION['username'],
                ));
        
            }else{
        
                $_SESSION['error'] = $errors;
        
                header('Location: reset_password.php');
        
            }
            
            //var_dump($errors); 
        
        }
        /**
         * Fin de Ré-initialiion du mot de passe
         */
        
        } else {
        
            echo 'Error'; 
            
        }

}catch(PDOException $e){
    echo $e->getMessage();
}
