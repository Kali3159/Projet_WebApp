<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include 'parts/header.php'; ?>
    <form action="/functions/requestHandler.php" method="post">
        <input type="hidden" name="action" value="register">
        Nom: <input type="text" name="nom" required><br>
        Prénom: <input type="text" name="prenom" required><br>
        Adresse: <input type="text" name="adresse" required><br>
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <?php include 'parts/footer.php'; ?>
</body>
</html>
