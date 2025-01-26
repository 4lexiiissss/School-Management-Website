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

if (isset($_POST['modifier'])) {
    $numetu= $_POST['numetu']; 
    $etudiantData = $etudiant->fetch($numetu);

    // Check if the etudiant data is null
    if ($etudiantData === null) {
        // Redirect to the etudiants list page
        header("Location: index.php?element=etudiants&action=list");
        exit();
    }
}
// Check if the save parameter is set in the POST request
if (isset($_POST['save'])) {
    // Update the etudiant data
    if ($etudiant->update($_POST)) {
        // Check if the confirm session variable is set
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        // Add a success message to the confirm session variable
        $_SESSION['mesgs']['confirm'][] = "Étudiant mis à jour avec succès.";
    } else {
        // Check if the error session variable is set
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        // Add an error message to the error session variable
        $_SESSION['mesgs']['error'][] = "Erreur lors de la mise à jour.";
    }

    // Redirect to the etudiant card page
    header("Location: index.php?element=etudiants&action=card&numetu=" . $_POST['numetu']);
    exit();
}

// Check if the mesgs session variable is set
if (isset($_SESSION['mesgs'])) {
    // Loop through the mesgs session variable
    foreach ($_SESSION['mesgs'] as $type => $messages) {
        // Loop through the messages
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
    // Unset the mesgs session variable
    unset($_SESSION['mesgs']);
}






