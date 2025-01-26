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

if (isset($_POST['voir_enseignant'])) {
    $numens = $_POST['numens'];
    
    // Fetch the enseignant object with the given numens
    $enseignant = $enseignant->fetch($numens);

    // Check if the enseignant object is null
    if ($enseignant === null) {
        // If the enseignant object is null, set an error message in the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        //$_SESSION['mesgs']['error'][] = "enseignant introuvable.";
        // Redirect to the enseignants list page
        header("Location: index.php?element=enseignants&action=list");
        exit();
    }
} else {
    // If the numens parameter is not set, set an error message in the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    //$_SESSION['mesgs']['error'][] = "Aucun enseignant séléctionné.";
    // Redirect to the enseignants list page
    header("Location: index.php?element=enseignants&action=list");
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