<?php
// Start a new session
session_start();

// Require the enseignant.class.php file
require_once(dirname(__FILE__) . '/../../class/enseignant.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Create a new enseignant object
$enseignant = new enseignant($pdo);

if (isset($_POST['modifier'])) {
    $numens= $_POST['numens']; 
    // Fetch the enseignant data based on the numensparameter
    $enseignantData = $enseignant->fetch($numens);

    // Check if the enseignant data is null
    if ($enseignantData === null) {
        // Redirect to the enseignants list page
        header("Location: index.php?element=enseignants&action=list");
        exit();
    }
}
// Check if the save parameter is set in the POST request
if (isset($_POST['save'])) {
    // Update the enseignant data
    if ($enseignant->update($_POST)) {
        // Check if the confirm session variable is set
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        // Add a success message to the confirm session variable
        $_SESSION['mesgs']['confirm'][] = "Enseignant mis à jour avec succès.";
    } else {
        // Check if the error session variable is set
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        // Add an error message to the error session variable
        $_SESSION['mesgs']['error'][] = "Erreur lors de la mise à jour.";
    }

    // Redirect to the enseignant card page
    header("Location: index.php?element=enseignants&action=card&numens=" . $_POST['numens']);
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






