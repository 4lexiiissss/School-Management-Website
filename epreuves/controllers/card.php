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

if (isset($_POST['voir_epreuve'])) {
    $numepr = $_POST['numepr'];
    
    // Fetch the epreuve object with the given numepr
    $epreuve = $epreuve->fetch($numepr);

    $classement = $epreuve->getClassement($numepr);

    // Check if the epreuve object is null
    if ($epreuve === null) {
        // If the epreuve object is null, set an error message in the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        //$_SESSION['mesgs']['error'][] = "epreuve introuvable.";
        // Redirect to the epreuves list page
        header("Location: index.php?element=epreuves&action=list");
        exit();
    }
} else {
    // If the numepr parameter is not set, set an error message in the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    //$_SESSION['mesgs']['error'][] = "Aucun epreuve séléctionné.";
    // Redirect to the epreuves list page
    header("Location: index.php?element=epreuves&action=list");
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