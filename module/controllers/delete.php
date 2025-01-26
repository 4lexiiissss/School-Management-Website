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

// Create a new module object
$module = new module($pdo);

// Check if the nummod is set in the POST request
if (isset($_POST['nummod'])) {
    $nummod = $_POST['nummod'];
    // Delete the module with the given nummod
    if ($module->delete($nummod)) {
        // If the module is deleted successfully, add a confirmation message to the session
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        $_SESSION['mesgs']['confirm'][] = "Module supprimé avec succès.";
        // Redirect to the list of modules
        header("Location: index.php?element=module&action=list");
        exit();
    } else {
        // If an error occurs during deletion, add an error message to the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        $_SESSION['mesgs']['error'][] = "Une erreur est survenue lors de suppression du module.";
        // Redirect to the list of modules
        header("Location: index.php?element=module&action=list");
        exit();
    }
} else {
    // If no module is selected to delete, add an error message to the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    $_SESSION['mesgs']['error'][] = "Aucun module sélectionné à supprimer.";
    exit();
}

// Check if there are any messages in the session
if (isset($_SESSION['mesgs'])) {
    // Loop through each type of message
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
    // Unset the messages from the session
    unset($_SESSION['mesgs']);
}

