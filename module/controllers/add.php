<?php
// Start a new session
session_start();

// Require the module.class.php file
require_once(dirname(__FILE__) . '/../../class/module.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Check if the confirm_envoyer button has been clicked
if (isset($_POST['confirm_envoyer'])) {
    // Create an array with the data from the form
    $module = new module($pdo, $_POST);

    // Check if the module object was created successfully
    if ($module->Create()) {
        
        // If so, redirect to the index.php page with a success message
        header("Location: index.php?element=module&action=list&message=module ajouté avec succès");
        // Check if the confirm session variable is set
        if (!isset($_SESSION['mesgs']['confirm'])) {
            // If not, create it
            $_SESSION['mesgs']['confirm'] = [];
        }
        // Add a success message to the confirm session variable
        $_SESSION['mesgs']['confirm'][] = "Création du module avec succès.";
        // Exit the script
        exit;
    } else {
        // If the module object was not created successfully, check if the error session variable is set
        if (!isset($_SESSION['mesgs']['error'])) {
            // If not, create it
            $_SESSION['mesgs']['error'] = [];
        }
        // Add an error message to the error session variable
        $_SESSION['mesgs']['error'][] = "Erreur lors de la création du module";
    }
} else {
    // If the confirm_envoyer button has not been clicked, do nothing
    echo "";
}


// Check if the mesgs session variable is set
if (isset($_SESSION['mesgs'])) {
    // If so, loop through each type of message
    foreach ($_SESSION['mesgs'] as $type => $messages) {
        // Loop through each message
        foreach ($messages as $mesg) {
            // Display the message in an alertbox
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