<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecole_db";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Traitement de l'inscription
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];
    $montant_payer = $_POST['montant_payer'];
    $classe = $_POST['classe'];

    $query = "INSERT INTO eleves (nom, prenom, sexe, date_naissance, montant_payer, classe) VALUES ('$nom', '$prenom', '$sexe', '$date_naissance', '$montant_payer', '$classe')";
    $result = $conn->query($query);

    if ($result) {
        $success_message = "Inscription réussie!";
        header("Location: ".$_SERVER['PHP_SELF']); // Rediriger vers la même page
        exit();
    } else {
        $error_message = "Erreur lors de l'inscription.";
    }
}

// Récupérer la liste des élèves
$query_students = "SELECT * FROM eleves ORDER BY nom";
$result_students = $conn->query($query_students);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription des élèves</title>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription des élèves</title>
    <style>
        /* Styles CSS ici... */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 20px;
            text-align: center;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        #view-list-link {
            position: absolute;
            top: 10px;
            right: 10px;
            text-decoration: none;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <a id="view-list-link" href="liste_eleves.php">Voir la liste des élèves</a>
    <div class="container">
        <?php if (isset($error_message)): ?>
            <div class="message error-message"><?php echo $error_message; ?></div>
        <?php elseif (isset($success_message)): ?>
            <div class="message success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>

</head>
<body>
    <!-- Formulaire d'inscription -->
    <div class="container">
        <?php if (isset($error_message)): ?>
            <div class="message error-message"><?php echo $error_message; ?></div>
        <?php elseif (isset($success_message)): ?>
            <div class="message success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <h2>Inscription des élèves</h2>
        <form method="post" action="">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" required>

            <label for="sexe">Sexe:</label>
            <select name="sexe" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>

            <label for="date_naissance">Date de naissance:</label>
            <input type="date" name="date_naissance" required>

            <label for="montant_payer">Montant à payer:</label>
            <input type="text" name="montant_payer" required>

            <label for="classe">Classe:</label>
            <input type="text" name="classe" required>

            <input type="submit" name="submit" value="S'inscrire">

        </form>
    </div>

    <!-- Bouton pour afficher la liste des élèves -->
    <form action="liste_eleves.php" method="get">
    </form>
</body>
</html>
