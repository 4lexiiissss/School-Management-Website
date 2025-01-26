<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Using CodeGeeX Ia for documentation

/**
 * Class representing a module.
 *
 * @package MyApp
 * @author Alexis Demol
 */
class Module
{
    // Declare private variables
    private object $pdo;
    private int $nummod;
    private string $nommod;
    private int $coefmod;

    // Constructor method
    public function __construct($pdo, $data = [])
    {
        // Assign the PDO object to the private variable
        $this->pdo = $pdo;
        // Set default values for the module
        $this->nommod = 'Non spécifié';
        $this->nummod = 0;
        $this->coefmod = 0;

        // If data is provided, hydrate the object
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    
    // Method to hydrate the object with data
    public function hydrate($data)
    {
        // If the data contains a nommod, assign it to the private variable
        if (!empty($data['nommod'])) {
            $this->nommod = $data['nommod'];
        } else {
            $this->nommod = '';
        }

        // If the data contains a coefmod and it is numeric, assign it to the private variable
        if (!empty($data['coefmod']) && is_numeric($data['coefmod'])) {
            $this->coefmod = (int) $data['coefmod'];
        } else {
            $this->coefmod = 0;
        }

        // If the data contains a nummod and it is numeric, assign it to the private variable
        if (!empty($data['nummod']) && is_numeric($data['nummod'])) {
            $this->nummod = (int) $data['nummod'];
        } else {
            $this->nummod = 0;
        }
    }

    // Method to validate the object
    public function validate()
    {
        // Create an array to store any errors
        $errors = [];

        // If the nommod is empty, add an error to the array
        if (empty($this->nommod)) {
            $errors[] = "Le nom du module est obligatoire.";
        }

        // If the nummod is empty or not numeric, add an error to the array
        if (empty($this->nummod) || !is_numeric($this->nummod)) {
            $errors[] = "Le numéro du module est obligatoire et doit être valide.";
        }

        // If the coefmod is empty or not numeric, add an error to the array
        if (empty($this->coefmod) || !is_numeric($this->coefmod)) {
            $errors[] = "Le coefficient du module est obligatoire et doit être valide.";
        }

        // If there are any errors, display them and return false
        if (!empty($errors)) {
            echo '<div class="alertbox errorbox">';
            foreach ($errors as $error) {
                echo '<div>' . htmlspecialchars($error) .
                    '<span class="closebtn">&times;</span></div>';
            }
            echo '</div>';

            return false; 
        }

        // If there are no errors, return true
        return true;

    }

    /*
    public function Create()
    {
        // Check if the form data is valid
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert data into the modules table
            $sql_module = "INSERT INTO modules (nummod, nommod, coefmod) 
                       VALUES (:nummod, :nommod, :coefmod)";

            // Prepare the SQL statement
            $stmt_module = $this->pdo->prepare($sql_module);
            // Bind the parameters to the SQL statement
            $stmt_module->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt_module->bindParam(':nommod', $this->nommod, PDO::PARAM_STR);
            $stmt_module->bindParam(':coefmod', $this->coefmod, PDO::PARAM_INT);

            // Execute the SQL statement
            if (!$stmt_module->execute()) {
                // If an error occurs, throw an exception
                throw new Exception("Erreur lors de l'insertion dans modules : " . implode(', ', $stmt_module->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->pdo->rollBack();

            // Check if the error code is 23000 (duplicate entry)
            if ($e->getCode() == 23000) {
                // If so, display an error message
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Le numéro de module que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
            </div>";
            } else {
                // Otherwise, display a general error message
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Une erreur est survenue lors de la création du module. Veuillez réessayer plus tard. <br>
            </div>";
            }

            return false;
        }
    }
        */



    // Create a new module
    public function Create()
    {
        // Validate the input data
        if (!$this->validate()) {
            return false;
        }

        try {
            // Begin a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert a new module
            $sql_module = "CALL ajout_module(:nummod, :nommod, :coefmod)";

            // Prepare the statement
            $stmt_module = $this->pdo->prepare($sql_module);
            // Bind the parameters to the statement
            $stmt_module->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt_module->bindParam(':nommod', $this->nommod, PDO::PARAM_STR);
            $stmt_module->bindParam(':coefmod', $this->coefmod, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt_module->execute()) {
                // If an error occurs, throw an exception
                throw new Exception("Erreur lors de l'insertion dans modules : " . implode(', ', $stmt_module->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->pdo->rollBack();

            // If the error code is 23000, it means that the module number is already used
            if ($e->getCode() == 23000) {
                echo "<div class='alertbox errorbox'>
                <span class='closebtn'>&times;</span>
                Le numéro de module que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
                </div>";
            } else {
                // Otherwise, display a generic error message
                echo "<div class='alertbox errorbox'>
                <span class='closebtn'>&times;</span>
                Une erreur est survenue lors de la création du module. Veuillez réessayer plus tard. <br>
                </div>";
            }

            return false;
        }
    }

    /*
    // Fetch a module by its number
    public function fetch($nummod)
    {
        // Prepare the SQL statement to fetch a module
        $query = "SELECT * FROM modules WHERE nummod = :nummod";
        // Prepare the statement
        $stmt = $this->pdo->prepare($query);
        // Bind the parameter to the statement
        $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);

        try {
            // Execute the statement
            $stmt->execute();
            // Fetch the data
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->hydrate($data);
                return $this;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
        */


    public function fetch($nummod)
    {
        // Prepare the SQL query to fetch a module by its number
        $query = 'SELECT * FROM fetch_module(:nummod)';
        $stmt = $this->pdo->prepare($query);
        // Bind the parameter to the query
        $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);

        try {
            // Execute the query
            $stmt->execute();
            // Fetch the data from the query
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // Hydrate the object with the data
                $this->hydrate($data);
                return $this;
            } else {
                // Return null if no data is found
                return null;
            }
        } catch (PDOException $e) {
            // Throw a runtime exception if there is an error executing the query
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }

    public function find($criteria)
    {
        // Prepare the SQL query to find a module by its name
        $sql = "SELECT * FROM modules WHERE nommod LIKE :nom";
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter to the query
        $stmt->bindValue(':nom', '%' . $criteria['nommod'] . '%', PDO::PARAM_STR);
        // Execute the query
        $stmt->execute();

        // Return the result of the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchAll(): array
    {
        // Prepare the SQL query to fetch all modules
        $sql = "SELECT * FROM modules";
        $stmt = $this->pdo->query($sql);
        // Return the result of the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    public function update($data)
    {
        // Hydrate the object with the data
        $this->hydrate($data);

        // Prepare the SQL query to update the module
        $query = "UPDATE modules 
              SET nommod = :nommod, coefmod = :coefmod 
              WHERE nummod = :nummod";

        // Prepare the statement
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the statement
        $stmt->bindParam(':nummod', $data['nummod'], PDO::PARAM_INT);
        $stmt->bindParam(':nommod', $data['nommod'], PDO::PARAM_STR);
        $stmt->bindParam(':coefmod', $data['coefmod'], PDO::PARAM_INT);

        // Execute the statement
        $result = $stmt->execute();

        // Return the result
        return $result;
    }
        */


    public function update($data)
    {
        // Hydrate the object with the data
        $this->hydrate($data);

        // Prepare the SQL query to modify a module
        $query = "SELECT modif_module(:nummod, :nommod, :coefmod)";
        // Prepare the statement
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the statement
        $stmt->bindParam(':nummod', $data['nummod'], PDO::PARAM_INT);
        $stmt->bindParam(':nommod', $data['nommod'], PDO::PARAM_STR);
        $stmt->bindParam(':coefmod', $data['coefmod'], PDO::PARAM_INT);

        // Execute the statement
        $result = $stmt->execute();

        // Return the result
        return $result;
    }

    // Function to delete a module
    public function delete($nummod)
    {
        try {
            // Begin a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL query to delete a module
            $sql = "DELETE FROM modules WHERE nummod = :nummod";
            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);
            // Bind the parameter to the statement
            $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt->execute()) {
                // Throw an exception if the statement fails
                throw new Exception("Erreur lors de la suppression du module.");
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if an exception is thrown
            $this->pdo->rollBack();
            // Print the error message
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    /*
    public function getClassement($nummod)
    {
        // Prepare a SQL statement to select the student's number, name, surname, and average grade
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
            JOIN 
                matieres mat ON epr.matepr = mat.nummat
            WHERE 
                mat.nummod = :nummod 
            GROUP BY 
                etu.numetu, etu.nometu, etu.prenometu
            ORDER BY 
                moyenne DESC
        ");
        // Execute the SQL statement with the given module number
        $stmt->execute([':nummod' => $nummod]);

        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    public function getClassement($nummod)
    {
        // Prepare a SQL statement to select the student's number, name, surname, and average grade
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_par_module(:nummod)");
        // Execute the SQL statement with the given module number
        $stmt->execute([':nummod' => $nummod]);

        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /*
    public function getClassementGeneral()
    {
        // Prepare the SQL query to get the general ranking
        $sql = "SELECT 
                    e.numetu, e.nometu, e.prenometu, 
                    m.nommod AS module, 
                    SUM(a.note) AS total_score
                FROM 
                    avoir_note a
                JOIN 
                    etudiants e ON a.numetu = e.numetu
                JOIN 
                    epreuves ep ON a.numepr = ep.numepr
                JOIN 
                    matieres ma ON ep.matepr = ma.nummat  
                JOIN 
                    modules m ON ma.nummod = m.nummod    
                GROUP BY 
                    e.numetu, e.nometu, e.prenometu, m.nommod
                ORDER BY 
                    total_score DESC";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL statement
        $stmt->execute();
        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    public function getClassementGeneral()
    {
        // Prepare the SQL statement to get the general ranking
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_general_module()");
        // Execute the SQL statement
        $stmt->execute();

        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /*
    public function getClassementParMatiere()
    {
        // Prepare the SQL query to select the classement by subject
        $sql = "SELECT 
                    ma.nommat AS matiere, 
                    e.numetu, e.nometu, e.prenometu, 
                    a.note AS score, 
                    mod.nommod AS module
                FROM 
                    avoir_note a
                JOIN 
                    etudiants e ON a.numetu = e.numetu
                JOIN 
                    epreuves ep ON a.numepr = ep.numepr
                JOIN 
                    matieres ma ON ep.matepr = ma.nummat  
                JOIN 
                    modules mod ON ma.nummod = mod.nummod 
                ORDER BY 
                    mod.nommod, ma.nommat, a.note DESC";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL statement
        $stmt->execute();
        // Return the result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        */

    public function getClassementParMatiere()
    {
        // Prepare the SQL query to select the classement by subject
        $sql = "SELECT * FROM get_classement_par_matiere_module()";
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        // Execute the SQL statement
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Getters 

    public function getPdo(): object
    {
        return $this->pdo;
    }

    public function getnommod(): string
    {
        return $this->nommod;
    }

    public function getnummod(): int
    {
        return $this->nummod;
    }

    public function getcoefmod(): int
    {
        return $this->coefmod;
    }

    // Setters

    public function setPdo(object $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function setnommod(string $nommod): void
    {
        $this->nommod = $nommod;
    }

    public function setnummod(int $nummod): void
    {
        $this->nummod = $nummod;
    }

    public function setcoefmod(int $coefmod): void
    {
        $this->coefmod = $coefmod;
    }

}
