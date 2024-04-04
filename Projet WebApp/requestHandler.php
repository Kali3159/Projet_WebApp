<?php
require_once 'functions/controller.php';

function handleRequest() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'functions/model.php';

        // Gestion de l'inscription
        if (isset($_POST['action']) && $_POST['action'] === 'register') {
            $success = registerUser($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['email'], $_POST['password']);
            if ($success) {
                // Inscription réussie, redirection vers la page de connexion
                header("Location: /login.php?success=1");
                exit();
            } else {
                // Échec de l'inscription, retour au formulaire avec un message d'erreur
                header("Location: /register.php?error=email_exists");
                exit();
            }
        }

        // Gestion de la connexion
        if (isset($_POST['action']) && $_POST['action'] === 'login') {
            $user = checkUserCredentials($_POST['email'], $_POST['password']);
            if ($user) {
                // Connexion réussie, initialisation de la session
                $_SESSION['user_id'] = $user['id'];
                header("Location: /profile.php");
                exit();
            } else {
                // Échec de la connexion, retour au formulaire avec un message d'erreur
                header("Location: /login.php?error=invalid_credentials");
                exit();
            }
        }
    }

    // Appelle le contrôleur pour déterminer quelle page afficher
    controller($uri);
}
