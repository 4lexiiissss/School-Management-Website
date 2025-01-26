<?php
// Start a new session
session_start();

// Require the etudiant.class.php file
require_once(dirname(__FILE__) . '/../../class/etudiant.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Create a new Etudiant object
$etudiant = new Etudiant($pdo);

if (isset($_POST['voir_etudiant'])) {
    $numetu = $_POST['numetu'];
    
    // Fetch the etudiant object with the given numetu
    $etudiant = $etudiant->fetch($numetu);

    $classement = $etudiant->getClassement($numetu);

    // Check if the etudiant object is null
    if ($etudiant === null) {
        // If the etudiant object is null, set an error message in the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        //$_SESSION['mesgs']['error'][] = "Etudiant introuvable.";
        // Redirect to the etudiants list page
        header("Location: index.php?element=etudiants&action=list");
        exit();
    }
} else {
    // If the numetu parameter is not set, set an error message in the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    //$_SESSION['mesgs']['error'][] = "Aucun étudiant séléctionné.";
    // Redirect to the etudiants list page
    header("Location: index.php?element=etudiants&action=list");
    exit();
}


// Check if there are messages in the session
if (isset($_SESSION['mesgs'])) {
    // Loop through the messages
    foreach ($_SESSION['mesgs'] as $type => $messages) {
        foreach ($messages as $mesg) {
            // Display the message
            ?>
            <div class="alertbox <?= $type === 'confirm' ? 'messagebox' : 'errorbox'; ?>">
                <span class="closebtn">&times;</span>
                <?= htmlspecialchars($mesg); ?>
            </div>
            <?php
        }
    }
    // Unset the messages from the session
    unset($_SESSION['mesgs']);
}