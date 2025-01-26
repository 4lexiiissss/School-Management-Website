<?php
// Start a new session
session_start();

// Require the matiere.class.php file
require_once(dirname(__FILE__) . '/../../class/matiere.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Create a new matiere object
$matiere = new matiere($pdo);

// Check if the nummat is set in the POST request
if (isset($_POST['nummat'])) {
    $nummat = $_POST['nummat'];
    // Delete the matiere with the given nummat
    if ($matiere->delete($nummat)) {
        // If the matiere is deleted successfully, add a confirmation message to the session
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        $_SESSION['mesgs']['confirm'][] = "matiere supprimé avec succès.";
        // Redirect to the list of matieres
        header("Location: index.php?element=matiere&action=list");
        exit();
    } else {
        // If an error occurs during deletion, add an error message to the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        $_SESSION['mesgs']['error'][] = "Une erreur est survenue lors de suppression du matiere.";
        // Redirect to the list of matieres
        header("Location: index.php?element=matiere&action=list");
        exit();
    }
} else {
    // If no matiere is selected to delete, add an error message to the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    $_SESSION['mesgs']['error'][] = "Aucun matiere sélectionné à supprimer.";
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

