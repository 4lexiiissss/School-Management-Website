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

if (isset($_POST['voir_matiere'])) {
    $nummat = $_POST['nummat'];
    
    // Fetch the matiere object with the given nummat
    $matiere = $matiere->fetch($nummat);

    $classement = $matiere->getClassement($nummat);

    // Check if the matiere object is null
    if ($matiere === null) {
        // If the matiere object is null, set an error message in the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        //$_SESSION['mesgs']['error'][] = "matiere introuvable.";
        // Redirect to the matieres list page
        header("Location: index.php?element=matiere&action=list");
        exit();
    }
} else {
    // If the nummat parameter is not set, set an error message in the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    //$_SESSION['mesgs']['error'][] = "Aucun matiere séléctionné.";
    // Redirect to the matieres list page
    header("Location: index.php?element=matiere&action=list");
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