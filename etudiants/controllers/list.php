<?php
// Start a new session
session_start();

// Require the etudiant.class.php file
require_once(dirname(__FILE__) . '/../../class/etudiant.class.php');

// Require the mypdo.php file
$pdo = require_once(dirname(__FILE__) . '/../../lib/mypdo.php');

// Check if the connection to the database is successful
if ($pdo === null) {
    die("Erreur de connexion à la base de données.");
}

// Get the value of the 'nom' parameter from the POST request
$nomFiltre = isset($_POST['nom']) ? $_POST['nom'] : '';
// Initialize an empty array to store the students
$etudiants = []; 

// Create a new instance of the Etudiant class
$etudiant = new Etudiant($pdo);

// If the 'nom' parameter is set
if ($nomFiltre) {
    // Find the students with the given last name
    $etudiants = $etudiant->find(['nometu' => $nomFiltre]);
} else {
    
    // Otherwise, fetch all the students
    $etudiants = $etudiant->fetchAll();
}
