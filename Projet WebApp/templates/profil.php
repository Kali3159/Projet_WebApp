<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php
    include 'parts/header.php';
    require_once '../functions/model.php';

    // Supposons que vous avez stocké l'ID de l'utilisateur dans $_SESSION['user_id']
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        // Si l'ID utilisateur n'est pas dans la session, rediriger vers la page de connexion
        header("Location: /login.php");
        exit();
    }

    $user = getUserById($userId);
    ?>

    <h2>Profil de l'utilisateur</h2>
    <?php if ($user): ?>
        <p>Nom: <?php echo htmlspecialchars($user['nom']); ?></p>
        <p>Prénom: <?php echo htmlspecialchars($user['prenom']); ?></p>
        <p>Adresse: <?php echo htmlspecialchars($user['adresse']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <!-- Formulaire pour modifier les informations -->
        <form action="/functions/requestHandler.php" method="post">
            <input type="hidden" name="action" value="updateProfile">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required><br>
            Prénom: <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required><br>
            Adresse: <input type="text" name="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>" required><br>
            Email: <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
            Mot de passe (laisser vide pour ne pas changer): <input type="password" name="password"><br>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else: ?>
        <p>Utilisateur non trouvé.</p>
    <?php endif; ?>

    <?php include 'parts/footer.php'; ?>
</body>
</html>
