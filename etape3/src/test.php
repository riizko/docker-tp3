<?php
$servername = "data"; // Nom du conteneur MariaDB
$username = "user";
$password = "password";
$dbname = "test_db";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// 1. Requête CRUD (CREATE/UPDATE): Incrémenter le compteur
$sql_update = "UPDATE compteur SET valeur = valeur + 1 WHERE id = 1";
if ($conn->query($sql_update) === TRUE) {
    // Si la mise à jour n'a affecté aucune ligne (première exécution), insérer
    if ($conn->affected_rows == 0) {
         $sql_insert = "INSERT INTO compteur (id, valeur) VALUES (1, 1)";
         $conn->query($sql_insert);
    }
}

// 2. Requête CRUD (READ): Lire le compteur
$sql_select = "SELECT valeur FROM compteur WHERE id = 1";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h1>✅ Succès! Étape 2 validée.</h1>";
        echo "<h2>La base de données contient actuellement: " . $row["valeur"] . " entrées.</h2>";
        echo "<p>Ce nombre change à chaque rafraîchissement. La communication PHP <-> MariaDB est fonctionnelle.</p>";
    }
} else {
    echo "0 résultats trouvés. Vérifiez votre script SQL.";
}

$conn->close();
?>
