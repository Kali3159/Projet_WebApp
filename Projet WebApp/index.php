<?php
require_once 'functions/requestHandler.php';

// Configuration des sessions pour utiliser Redis
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://localhost:6379');

session_start();

// Appelle la fonction qui va traiter la requête.
handleRequest();
