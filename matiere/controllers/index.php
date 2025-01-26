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

// Fetch general rankings for all subjects
$classementGeneral = $matiere->getClassementGeneral();
$classementParEpreuve = $matiere->getClassementParEpreuve();

// Check for session messages
if (isset($_SESSION['mesgs'])) {
    foreach ($_SESSION['mesgs'] as $type => $messages) {
        foreach ($messages as $mesg) {
            ?>
            <div class="alertbox <?= $type === 'confirm' ? 'messagebox' : 'errorbox'; ?>">
                <span class="closebtn">&times;</span>
                <?= htmlspecialchars($mesg); ?>
            </div>
            <?php
        }
    }
    unset($_SESSION['mesgs']);
}
?>
