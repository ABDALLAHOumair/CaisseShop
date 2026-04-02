<?php
session_start();
require_once(__DIR__ . '/../fonciton/fonctions.php');
require_once(__DIR__ . '/../fonciton/ConnexionBDD.php');
$postData = $_POST;

// Validation du formulaire
if (isset($postData['email']) &&  isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Il vous faut un email valide.';
        die(redirectToUrl('login.php'));
    } 

    else {
        $RequeteUserTargget='SELECT Id, Nom, Prenom, Email, Password FROM users WHERE Email =:Email';
        $UserTargget=$mysqlClient->prepare($RequeteUserTargget);
        $UserTargget->execute([
            'Email' => $postData['email'],
        ]);
        $User=$UserTargget->fetchAll();
            if (
                $User[0]['Email'] === $postData['email'] && $User[0]['Password'] == $postData['password']
            ) {
                $_SESSION['LOGGED_USER'] = [
                    'nom' => $User[0]['Nom'],
                    'prenom' => $User[0]['Prenom'],
                    'email' => $User[0]['Email'],
                    'user_id' => $User[0]['Id'],
                ];
                die(redirectToUrl('point-de-vente.php'));
            }
            else {
                $_SESSION['LOGIN_ERROR_MESSAGE'] =  "L'email ou le mot de passe est incorrect.";
                die(redirectToUrl('login.php'));
            }
        }

    redirectToUrl('point-de-vente.php');
}
