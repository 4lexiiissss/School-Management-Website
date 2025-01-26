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

// Check if the numens is set in the POST request
if (isset($_POST['numens'])) {
    $numens = $_POST['numens'];
    // Delete the enseignant with the given numens
    if ($enseignant->delete($numens)) {
        // If the enseignant is deleted successfully, add a confirmation message to the session
        if (!isset($_SESSION['mesgs']['confirm'])) {
            $_SESSION['mesgs']['confirm'] = [];
        }
        $_SESSION['mesgs']['confirm'][] = "Étudiant supprimé avec succès.";
        // Redirect to the list of enseignants
        header("Location: index.php?element=enseignants&action=list");
        exit();
    } else {
        // If an error occurs during deletion, add an error message to the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        $_SESSION['mesgs']['error'][] = "Une erreur est survenue lors de suppression de l'étudiant.";
        // Redirect to the list of enseignants
        header("Location: index.php?element=enseignants&action=list");
        exit();
    }
} else {
    // If no enseignant is selected to delete, add an error message to the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    $_SESSION['mesgs']['error'][] = "Aucun étudiant sélectionné à supprimer.";
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

