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

if (isset($_POST['voir_module'])) {
    $nummod = $_POST['nummod'];
    
    // Fetch the module object with the given nummod
    $module = $module->fetch($nummod);

    $classement = $module->getClassement($nummod);

    // Check if the module object is null
    if ($module === null) {
        // If the module object is null, set an error message in the session
        if (!isset($_SESSION['mesgs']['error'])) {
            $_SESSION['mesgs']['error'] = [];
        }
        //$_SESSION['mesgs']['error'][] = "module introuvable.";
        // Redirect to the modules list page
        header("Location: index.php?element=module&action=list");
        exit();
    }
} else {
    // If the nummod parameter is not set, set an error message in the session
    if (!isset($_SESSION['mesgs']['error'])) {
        $_SESSION['mesgs']['error'] = [];
    }
    //$_SESSION['mesgs']['error'][] = "Aucun module séléctionné.";
    // Redirect to the modules list page
    header("Location: index.php?element=module&action=list");
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