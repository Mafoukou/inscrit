<?php
// Inclure la connexion à la base de données ici
include_once('config.php');

// Récupérer la liste des classes
$query_classes = "SELECT DISTINCT classe FROM eleves";
$result_classes = $conn->query($query_classes);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des élèves inscrits</title>
    <style>
        /* Styles CSS ici... */
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

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%; /* Utiliser 100% de la largeur de l'écran */
    margin-top: 20px;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow-x: auto; /* Ajouter une barre de défilement horizontale si nécessaire */
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

.class-section {
    margin-bottom: 30px;
}

#home-link {
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
    <a id="home-link" href="index.php">Accueil</a>
    
    <?php while ($class_row = $result_classes->fetch_assoc()): ?>
        <div class="class-section">
            <h2>Liste des élèves inscrits - Classe <?php echo $class_row['classe']; ?></h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Date de Naissance</th>
                    <th>Montant à Payer</th>
                    <th>Classe</th>
                </tr>

                <?php
                // Récupérer la liste des élèves pour la classe actuelle
                $current_class = $class_row['classe'];
                $query_students = "SELECT * FROM eleves WHERE classe = '$current_class' ORDER BY nom";
                $result_students = $conn->query($query_students);

                while ($row = $result_students->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['prenom']; ?></td>
                        <td><?php echo $row['sexe']; ?></td>
                        <td><?php echo $row['date_naissance']; ?></td>
                        <td><?php echo $row['montant_payer']; ?></td>
                        <td><?php echo $row['classe']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    <?php endwhile; ?>
</body>
</html>
