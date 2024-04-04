<?php
require_once 'functions/model.php'; // Pour interagir avec la base de données

function controller($uri) {
    session_start(); // Démarre la session pour gérer les connexions

    switch ($uri) {
        case '/login':
            require 'templates/login.php';
            break;
        case '/register':
            require 'templates/register.php';
            break;
        case '/profile':
            require 'templates/profile.php'; // Notez l'orthographe américaine de 'profil'
            break;
        default:
            require 'templates/home.php';
    }
}
