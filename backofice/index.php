<?php 
session_start();

include '../class/Autoloader.php'; 
Autoloader::register();

?> 

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Se connecter</h1>
    <form action="login.php" method="post">
    <label for="username">Utilisateur</label>
    <input type="text" name="username" id="username" placeholder="Votre nom d'utilisateur" class="">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" class="" placeholder="Votre mot de passe">
    <input type="submit" value="Connexion" class="">
    </form>

    <?php if(array_key_exists('error_log', $_SESSION)): ?>
    <strong>Le nom d'utilisateur ou le mot de passe sont incorrects</strong>
    <?php endif; ?>
    <?php unset($_SESSION['error_log']); ?> 

</body>
</html>