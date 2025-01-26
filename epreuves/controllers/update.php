<?php
// Start a new session
session_start();

// Require the epreuve.class.php file
require_once(dirname(__FILE__) . '/../../class/epreuve.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Create a new epreuve object
$epreuve = new epreuve($pdo);

// Check if the numeprparameter is set in the GET request
if (isset($_POST['modifier'])) {
    // Get the numeprparameter as an integer
    $numepr= $_POST['numepr']; 
    // Fetch the epreuve data based on the numeprparameter
    $epreuveData = $epreuve->fetch($numepr);

    // Check if the epreuve data is null
    if ($epreuveData === null) {
        // Redirect to the epreuves list page
        header("Location: index.php?element=epreuves&action=list");
        exit();
    }
}
// Check if the save parameter is set in the POST request
if (isset($_POST['save'])) {
    // Update the epreuve data
    if ($epreuve->update($_POST)) {
        // Check if the confirm session variable is set
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        // Add a success message to the confirm session variable
        $_SESSION['mesgs']['confirm'][] = "Epreuve mis à jour avec succès.";
    } else {
        // Check if the error session variable is set
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        // Add an error message to the error session variable
        $_SESSION['mesgs']['error'][] = "Erreur lors de la mise à jour.";
    }

    // Redirect to the epreuve card page
    header("Location: index.php?element=epreuves&action=card&numepr=" . $_POST['numepr']);
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






