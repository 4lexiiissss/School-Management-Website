<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Using CodeGeeX Ia for documentation

/**
 * Class representing a subject.
 *
 * @package MyApp
 * @author Alexis Demol
 */
class matiere
{
    // Declare private variables
    private object $pdo;
    private int $nummat;
    private string $nommat;
    private int $coefmat;
    private int $nummod;

    // Constructor function
    public function __construct($pdo, $data = [])
    {
        // Assign the PDO object to the private variable
        $this->pdo = $pdo;
        // Assign default values to the private variables
        $this->nommat = 'Non spécifié';
        $this->nummat = 0;
        $this->coefmat = 0;
        $this->nummod = 0;

        // If data is passed in, call the hydrate function
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // Hydrate function
    public function hydrate($data)
    {

        // If nommat is in the data array, assign it to the private variable
        if (!empty($data['nommat'])) {
            $this->nommat = $data['nommat'];
        } else {
            // Otherwise, assign an empty string
            $this->nommat = '';
        }

        // If coefmat is in the data array and is numeric, assign it to the private variable
        if (!empty($data['coefmat']) && is_numeric($data['coefmat'])) {
            $this->coefmat = (int) $data['coefmat'];
        } else {
            // Otherwise, assign 0
            $this->coefmat = 0;
        }

        // If nummat is in the data array and is numeric, assign it to the private variable
        if (!empty($data['nummat']) && is_numeric($data['nummat'])) {
            $this->nummat = (int) $data['nummat'];
        } else {
            // Otherwise, assign 0
            $this->nummat = 0;
        }

        // If nummod is in the data array and is numeric, assign it to the private variable
        if (!empty($data['nummod']) && is_numeric($data['nummod'])) {
            $this->nummod = (int) $data['nummod'];
        } else {
            // Otherwise, assign 0
            $this->nummod = 0;
        }
    }

    // Function to validate the data entered by the user
    public function validate()
    {
        // Initialize an empty array to store any errors
        $errors = [];

        // Check if the name of the subject is empty
        if (empty($this->nommat)) {
            // If it is, add an error message to the array
            $errors[] = "Le nom de la matiere est obligatoire.";
        }

        // Check if the code of the subject is empty or not a number
        if (empty($this->nummat) || !is_numeric($this->nummat)) {
            // If it is, add an error message to the array
            $errors[] = "Le code de la matiere est obligatoire et doit être valide.";
        }

        // Check if the coefficient of the subject is empty or not a number
        if (empty($this->coefmat) || !is_numeric($this->coefmat)) {
            // If it is, add an error message to the array
            $errors[] = "Le coefficient de la matiere est obligatoire et doit être valide.";
        }

        if (empty($this->nummod) || !is_numeric($this->nummod)) {
            $errors[] = "Le numéro du module est obligatoire et doit être valide.";
        }

        if (!empty($errors)) {
            echo '<div class="alertbox errorbox">';
            foreach ($errors as $error) {
                echo '<div>' . htmlspecialchars($error) .
                    '<span class="closebtn">&times;</span></div>';
            }
            echo '</div>';

            return false;
        }

        return true;

    }

    /*
    public function Create()
    {
        // Check if the form is valid
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert a new record into the matieres table
            $sql_matiere = "INSERT INTO matieres (nummat, nommat, nummod, coefmat) 
                        VALUES (:nummat, :nommat, :nummod, :coefmat)";

            // Prepare the SQL statement
            $stmt_matiere = $this->pdo->prepare($sql_matiere);

            $stmt_matiere->bindParam(':nummat', $this->nummat, PDO::PARAM_INT);
            $stmt_matiere->bindParam(':nommat', $this->nommat, PDO::PARAM_STR);
            $stmt_matiere->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt_matiere->bindParam(':coefmat', $this->coefmat, PDO::PARAM_INT);

            if (!$stmt_matiere->execute()) {
                throw new Exception("Erreur lors de l'insertion dans matieres : " . implode(', ', $stmt_matiere->errorInfo()));
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();

            if ($e->getCode() == 23000) {
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Le numéro de matière que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
            </div>";
            } else {
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Une erreur est survenue lors de la création de la matière. Veuillez réessayer plus tard. <br>
            </div>";
            }

            return false;
        }
    }
        */


    public function Create()
    {
        // Check if the form data is valid
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert a new record into the matieres table
            $sql_matiere = "CALL ajout_matiere(:nummat, :nommat, :nummod, :coefmat)";

            // Prepare the statement
            $stmt_matiere = $this->pdo->prepare($sql_matiere);
            // Bind the parameters to the statement
            $stmt_matiere->bindParam(':nummat', $this->nummat, PDO::PARAM_INT);
            $stmt_matiere->bindParam(':nommat', $this->nommat, PDO::PARAM_STR);
            $stmt_matiere->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt_matiere->bindParam(':coefmat', $this->coefmat, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt_matiere->execute()) {
                // If an error occurs, throw an exception
                throw new Exception("Erreur lors de l'insertion dans matieres : " . implode(', ', $stmt_matiere->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->pdo->rollBack();

            if ($e->getCode() == 23000) {
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Le numéro de matière que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
            </div>";
            } else {
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Une erreur est survenue lors de la création de la matière. Veuillez réessayer plus tard. <br>
            </div>";
            }

            return false;
        }
    }

    /*
    public function fetch($nummat)
    {
        // Prepare the SQL query to fetch the data from the matieres table
        $query = 'SELECT * FROM matieres WHERE nummat = :nummat';
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($query);

        // Bind the nummat parameter to the SQL statement
        $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);

        // Execute the SQL statement
        try {
            $stmt->execute();
            // Fetch the data from the SQL statement
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // If data is found, hydrate the object with the data and return the object
            if ($data) {
                $this->hydrate($data);
                return $this;
            // If no data is found, return null
            } else {
                return null;
            }
        // If an error occurs, throw a RuntimeException
        } catch (PDOException $e) {
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
        */

    public function fetch($nummat)
    {
        // Prepare the SQL query to fetch the data from the matieres table
        $query = 'SELECT * FROM fetch_matiere(:nummat)';
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($query);
        // Bind the nummat parameter to the SQL statement
        $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);

        // Execute the SQL statement
        try {
            $stmt->execute();
            // Fetch the data from the SQL statement
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // If data is found, hydrate the object with the data and return the object
            if ($data) {
                $this->hydrate($data);
                return $this;
            // If no data is found, return null
            } else {
                return null;
            }
        // If an error occurs, throw a RuntimeException
        } catch (PDOException $e) {
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }

    public function find($criteria)
    {
        // Prepare the SQL query to find the data from the matieres table
        $sql = "SELECT * FROM matieres WHERE nommat LIKE :nom";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the nom parameter to the SQL statement
        $stmt->bindValue(':nom', '%' . $criteria['nommat'] . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //This function fetches all the data from the matieres table
    public function fetchAll(): array
    {
        //SQL query to select all data from the matieres table
        $sql = "SELECT * FROM matieres";
        //Query the database with the SQL query
        $stmt = $this->pdo->query($sql);
        //Return the result of the query as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    //This function updates the data in the matieres table
    public function update($data)
    {
        //Hydrate the data with the data passed in
        $this->hydrate($data);

        //SQL query to update the matieres table
        $query = "UPDATE matieres SET 
              nommat = :nommat,
              nummod = :nummod,
              coefmat = :coefmat
              WHERE nummat = :nummat";
        //Prepare the SQL query
        $stmt = $this->pdo->prepare($query);

        //Bind the parameters to the SQL query
        $stmt->bindParam(':nummat', $data['nummat'], PDO::PARAM_INT);
        $stmt->bindParam(':nommat', $data['nommat'], PDO::PARAM_STR);
        $stmt->bindParam(':nummod', $data['nummod'], PDO::PARAM_INT);
        $stmt->bindParam(':coefmat', $data['coefmat'], PDO::PARAM_INT);

        //Execute the SQL query
        $result = $stmt->execute();

        //Return the result of the query
        return $result; 
    }
    */

    // Update the data in the database
    public function update($data)
    {
        // Hydrate the data
        $this->hydrate($data);

        // Prepare the query
        $query = "SELECT modif_matiere(:nummat, :nommat, :nummod, :coefmat)";
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the query
        $stmt->bindParam(':nummat', $data['nummat'], PDO::PARAM_INT);
        $stmt->bindParam(':nommat', $data['nommat'], PDO::PARAM_STR);
        $stmt->bindParam(':nummod', $data['nummod'], PDO::PARAM_INT);
        $stmt->bindParam(':coefmat', $data['coefmat'], PDO::PARAM_INT);

        // Execute the query
        $result = $stmt->execute();

        // Return the result
        return $result;
    }

    // Delete the data from the database
    public function delete($nummat)
    {
        try {
            // Begin a transaction
            $this->pdo->beginTransaction();

            // Prepare the query
            $sql = "DELETE FROM matieres WHERE nummat = :nummat";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de la suppression de la matière.");
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    /*
    //This function retrieves the ranking of students for a given subject
    public function getClassement($nummat)
    {
        //Prepare a SQL statement to select the student's number, name, surname, and average grade for a given subject
        $stmt = $this->pdo->prepare("
            SELECT 
                etu.numetu,
                etu.nometu AS nom,
                etu.prenometu AS prenom,
                ROUND(AVG(anote.note), 2) AS moyenne
            FROM 
                avoir_note anote
            JOIN 
                epreuves epr ON anote.numepr = epr.numepr
            JOIN 
                etudiants etu ON anote.numetu = etu.numetu
            WHERE 
                epr.matepr = :nummat 
            GROUP BY 
                etu.numetu, etu.nometu, etu.prenometu
            ORDER BY 
                moyenne DESC
        ");
        //Execute the SQL statement with the given subject number
        $stmt->execute([':nummat' => $nummat]);

        //Return the result of the SQL statement
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    //This function retrieves the ranking of students for a given subject
    public function getClassement($nummat)
    {
        //Prepare a SQL statement to select all columns from the get_classement_par_matiere function with the given subject number
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_par_matiere(:nummat)");
        //Execute the SQL statement with the given subject number
        $stmt->execute([':nummat' => $nummat]);

        //Return the result of the SQL statement
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* 
    // This function returns the general ranking of students
    public function getClassementGeneral()
    {
        // Prepare the SQL query to select the student's number, name, first name and total score
        $sql = "
        SELECT 
            e.numetu, 
            e.nometu, 
            e.prenometu, 
            SUM(an.note * ep.coefepr * m.coefmat) AS total_score
        FROM 
            etudiants e
        JOIN 
            avoir_note an ON e.numetu = an.numetu
        JOIN 
            epreuves ep ON an.numepr = ep.numepr
        JOIN 
            matieres m ON ep.matepr = m.nummat
        GROUP BY 
            e.numetu, e.nometu, e.prenometu
        ORDER BY 
            total_score DESC
    ";
        // Prepare the SQL query
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL query
        $stmt->execute();
        // Return the result of the SQL query
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    // This function returns the general ranking of students
    public function getClassementGeneral()
    {
        // Prepare the SQL query to select all from the function get_classement_general()
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_general()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    public function getClassementParEpreuve()
    {
        // Prepare the SQL query to select the ranking by subject
        $sql = "
        SELECT 
            m.nommat AS matiere, 
            ep.libepr AS epreuve, 
            e.nometu, 
            e.prenometu, 
            an.note * ep.coefepr AS score
        FROM 
            etudiants e
        JOIN 
            avoir_note an ON e.numetu = an.numetu
        JOIN 
            epreuves ep ON an.numepr = ep.numepr
        JOIN 
            matieres m ON ep.matepr = m.nummat
        ORDER BY 
            m.nommat, ep.libepr, score DESC
    ";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL statement
        $stmt->execute();
        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    public function getClassementParEpreuve()
    {
        // Prepare the SQL query to select the ranking by subject
        $sql = "SELECT * FROM get_classement_par_epreuve_matiere()";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL statement
        $stmt->execute();
        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Getters 

    public function getPdo(): object
    {
        return $this->pdo;
    }

    public function getnummod(): int
    {
        return $this->nummod;
    }

    public function getnommat(): string
    {
        return $this->nommat;
    }

    public function getnummat(): int
    {
        return $this->nummat;
    }

    public function getcoefmat(): int
    {
        return $this->coefmat;
    }

    // Setters

    public function setPdo(object $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function setnommat(string $nommat): void
    {
        $this->nommat = $nommat;
    }

    public function setnummat(int $nummat): void
    {
        $this->nummat = $nummat;
    }

    public function setcoefmat(int $coefmat): void
    {
        $this->coefmat = $coefmat;
    }

    public function setnummod(int $nummod): void
    {
        $this->nummod = $nummod;
    }

}
