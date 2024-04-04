<?php
require_once 'db.php'; // Assurez-vous d'avoir un fichier db.php pour la connexion à MySQL

// Fonction pour enregistrer un nouvel utilisateur
function registerUser($nom, $prenom, $adresse, $email, $password) {
    $pdo = getPDO();
    // Vérifie si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return false; // Email déjà utilisé
    }

    // Insère le nouvel utilisateur
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, adresse, email, password, role) VALUES (?, ?, ?, ?, ?, '2')");
    $stmt->execute([$nom, $prenom, $adresse, $email, $passwordHash]);
    return true;
}

// Fonction pour vérifier les identifiants de l'utilisateur
function checkUserCredentials($email, $password) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return $user; // Retourne les infos de l'utilisateur si les credentials sont corrects
    }
    return false;
}

// Fonction pour obtenir les informations d'un utilisateur par son ID
function getUserById($id) {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT id, nom, prenom, adresse, email, role FROM utilisateurs WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Fonction pour mettre à jour les informations d'un utilisateur
function updateUser($id, $nom, $prenom, $email, $password = null) {
    $pdo = getPDO();
    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?" . ($password ? ", password = ?" : "") . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $params = [$nom, $prenom, $email];
    if ($password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $params[] = $passwordHash;
    }
    $params[] = $id;
    $stmt->execute($params);
    return true;
}
