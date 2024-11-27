<?php
include 'database.php';

// Vérifiez si la clé "idElecteur" est définie dans $_GET
if (isset($_GET['code_ListeCand'])) {
    $code_ListeCand = $_GET['code_ListeCand'];

    $sql = "SELECT * FROM liste_candidat WHERE code_ListeCand = '$code_ListeCand'";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Construire un tableau associatif avec les données de l'électeur
        $region = array(
            'code_ListeCand' => $row['code_ListeCand'],
            'nomListe' => $row['nomListe'],
          
            
        );

        // Convertir le tableau associatif en format JSON et afficher la réponse
        echo json_encode($region);
    } else {
        // Si l'électeur n'est pas trouvé, renvoyer une réponse vide ou un message d'erreur
        echo json_encode(array('message' => 'Électeur introuvable.'));
    }
} else {
    // Si la clé "idElecteur" n'est pas définie dans $_GET, renvoyer une réponse d'erreur
    echo json_encode(array('message' => 'Clé "idElecteur" non définie.'));
}

// Fermer la connexion à la base de données
$mysqli->close();
?>