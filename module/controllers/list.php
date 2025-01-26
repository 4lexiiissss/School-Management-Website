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

// Get the value of the 'nom' parameter from the POST request
$nomFiltre = isset($_POST['nom']) ? $_POST['nom'] : '';
// Initialize an empty array to store the students
$modules = []; 

// Create a new instance of the module class
$module = new module($pdo);

// If the 'nom' parameter is set
if ($nomFiltre) {
    // Find the students with the given last name
    $modules = $module->find(['nommod' => $nomFiltre]);
} else {
    
    // Otherwise, fetch all the students
    $modules = $module->fetchAll();
}
