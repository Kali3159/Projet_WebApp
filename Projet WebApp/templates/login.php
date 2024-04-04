<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include 'parts/header.php'; ?>
    <form action="/functions/requestHandler.php" method="post">
        <input type="hidden" name="action" value="login">
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
    <?php include 'parts/footer.php'; ?>
</body>
</html>
