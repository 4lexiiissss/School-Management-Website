<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Using CodeGeeX Ia for documentation

/**
 * Class representing an exam.
 *
 * @package MyApp
 * @author Alexis Demol
 */
class Epreuve
{
    // Declare private variables
    private object $pdo;
    private int $numepr;
    private string $libepr;
    private string $ensepr;

    private string $matepr;

    private string $datepr;
    private int $coefepr;
    private int $annepr;

    // Constructor method
    public function __construct($pdo, $data = [])
    {
        // Assign the PDO object to the private variable
        $this->pdo = $pdo;
        // Initialize the private variables with default values
        $this->numepr = 0;
        $this->ensepr = 'Non spécifié';
        $this->libepr = 'Non spécifié';
        $this->matepr = 'Non spécifié';
        $this->datepr = 'Non spécifié';
        $this->coefepr = 0;
        $this->annepr = 0;

        // If data is provided, call the hydrate method
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    // Method to hydrate the object with data
    public function hydrate($data)
    {

        // If numepr is provided and is numeric, assign it to the private variable
        if (!empty($data['numepr']) && is_numeric($data['numepr'])) {
            $this->numepr = (int) $data['numepr'];
        } else {
            $this->numepr = 0;
        }

        // If ensepr is, assign it to the private variable
        if (!empty($data['ensepr'])) {
            $this->ensepr = $data['ensepr'];
        } else {
            $this->ensepr = '';
        }

        // If libepr is provided, assign it to the private variable
        if (!empty($data['libepr'])) {
            $this->libepr = $data['libepr'];
        } else {
            $this->libepr = '';
        }

        // If matepr is provided, assign it to the private variable
        if (!empty($data['matepr'])) {
            $this->matepr = $data['matepr'];
        } else {
            $this->matepr = '';
        }

        // If datepr is provided, assign it to the private variable
        if (!empty($data['datepr'])) {
            $this->datepr = $data['datepr'];
        } else {
            $this->datepr = '';
        }
       
        // If coefepr is provided and is numeric, assign it to the private variable
        if (!empty($data['coefepr']) && is_numeric($data['coefepr'])) {
            $this->coefepr = (int) $data['coefepr'];
        } else {
            $this->coefepr = 0;
        }

        // If annepr is provided and is numeric, assign it to the private variable
        if (!empty($data['annepr']) && is_numeric($data['annepr'])) {
            $this->annepr = (int) $data['annepr'];
        } else {
            $this->annepr = 0;
        }
    }

    // Function to validate the form data
    public function validate()
    {
        // Initialize an empty array to store errors
        $errors = [];

        // Check if the number of the exam is empty
        if (empty($this->numepr)) {
             
            // Add an error message to the array
            $errors[] = "Le numéro de l'épreuve est obligatoire.";
        }

        // Check if the label of the exam is empty
        if (empty($this->libepr)) {
             
            // Add an error message to the array
            $errors[] = "Le libele de l'épreuve est obligatoire.";
        }
        // Check if the subject of the exam is empty
        if (empty($this->matepr)) {
             
            // Add an error message to the array
            $errors[] = "La matière de l'épreuve est obligatoire.";
        }
        // Check if the teacher's number is empty
        if (empty($this->ensepr)) {
             
            // Add an error message to the array
            $errors[] = "Le numéro de l'enseignant est obligatoire.";
        }
    
        // Check if the date of the exam is empty
        if (empty($this->datepr)) {
             
            // Add an error message to the array
            $errors[] = "La date de l'épreuve est obligatoire.";
        }
        // Check if the coefficient of the exam is empty
        if (!isset($_POST['coefepr']) || trim($_POST['coefepr']) === '') {
            // Add an error message to the array
            $errors[] = "Le coefficient de l'épreuve est obligatoire.";
        } elseif ((int) $_POST['coefepr'] <= 0) {
            // Add an error message to the array
            $errors[] = "Le coefficient doit être un entier positif.";
        }

        // Check if the year of the exam is empty
        if (empty($this->annepr)) {
             
            // Add an error message to the array
            $errors[] = "L'année de l'épreuve est obligatoire.";
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
        // Check if the form data is valid
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert the data into the database
            $sql_epreuve = "INSERT INTO epreuves (numepr, libepr, ensepr, matepr, datepr, coefepr, annepr)
                        VALUES (:numepr, :libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr)";

            $stmt_epreuve = $this->pdo->prepare($sql_epreuve);

            // Bind the parameters to the SQL statement
            $stmt_epreuve->bindParam(':numepr', $this->numepr, PDO::PARAM_INT);
            $stmt_epreuve->bindParam(':libepr', $this->libepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':ensepr', $this->ensepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':matepr', $this->matepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':datepr', $this->datepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':coefepr', $this->coefepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':annepr', $this->annepr, PDO::PARAM_INT);

            // Execute the SQL statement
            if (!$stmt_epreuve->execute()) {
                throw new Exception("Erreur lors de l'insertion de l'épreuve : " . implode(', ', $stmt_epreuve->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->pdo->rollBack();

            // Display an error message
            echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Erreur lors de la création de l'épreuve : " . htmlspecialchars($e->getMessage()) . "
        </div>";
            return false;
        }
    }
        */

    // Function to create a new exam
    public function Create()
    {
        // Validate the input data
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement to insert a new exam
            $sql_epreuve = "CALL ajout_epreuve(:numepr, :libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr)";
            $stmt_epreuve = $this->pdo->prepare($sql_epreuve);

            // Bind the input data to the SQL statement
            $stmt_epreuve->bindParam(':numepr', $this->numepr, PDO::PARAM_INT);
            $stmt_epreuve->bindParam(':libepr', $this->libepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':ensepr', $this->ensepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':matepr', $this->matepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':datepr', $this->datepr, PDO::PARAM_STR);
            $stmt_epreuve->bindParam(':coefepr', $this->coefepr, PDO::PARAM_INT);
            $stmt_epreuve->bindParam(':annepr', $this->annepr, PDO::PARAM_STR);

            // Execute the SQL statement
            if (!$stmt_epreuve->execute()) {
                throw new Exception("Erreur lors de l'insertion de l'épreuve : " . implode(', ', $stmt_epreuve->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->pdo->rollBack();

            echo "<div class='alertbox errorbox'>
                    <span class='closebtn'>&times;</span>
                    Erreur lors de la création de l'épreuve : " . htmlspecialchars($e->getMessage()) . "
                </div>";
            return false;
        }
    }

    /*
    //This function fetches a record from the epreuves table based on the numepr parameter
    public function fetch($numepr)
    {
        //Prepare a SQL query to select all columns from the epreuves table where numepr matches the parameter
        $query = 'SELECT * FROM epreuves WHERE numepr = :numepr';
        //Prepare the SQL query using the PDO prepare method
        $stmt = $this->pdo->prepare($query);
        //Bind the numepr parameter to the SQL query using the PDO bindParam method
        $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);

        try {
            //Execute the SQL query
            $stmt->execute();
            //Fetch the result of the SQL query as an associative array
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            //If the result is not null, hydrate the object with the data and return the object
            if ($data) {
                $this->hydrate($data);
                return $this;
            //If the result is null, return null
            } else {
                return null; 
            }
        //If an error occurs during the execution of the SQL query, throw a RuntimeException
        } catch (PDOException $e) {
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
        */


    // Fetches a single epreuve from the database based on the given numepr
    public function fetch($numepr)
    {
        // Prepare the SQL query to fetch the epreuve
        $query = 'SELECT * FROM fetch_epreuve(:numepr)';
        $stmt = $this->pdo->prepare($query);
        // Bind the numepr parameter to the query
        $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);

        try {
            // Execute the query
            $stmt->execute();
            // Fetch the data from the query result
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // If data is found, hydrate the object with the data and return the object
            if ($data) {
                $this->hydrate($data);
                return $this;
            // If no data is found, return null
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // If an error occurs, throw a RuntimeException with the error message
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }


    // Finds epreuves based on the given criteria
    public function find($criteria)
    {
        // Prepare the SQL query to find the epreuves
        $sql = "SELECT * FROM epreuves WHERE libepr LIKE :libepr";
        $stmt = $this->pdo->prepare($sql);

        // Bind the libepr parameter to the query
        $stmt->bindValue(':libepr', '%' . $criteria['libepr'] . '%', PDO::PARAM_STR);
        // Execute the query
        $stmt->execute();

        // Return the result of the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Fetches all epreuves from the database
    public function fetchAll(): array
    {
        // Prepare the SQL query to fetch all epreuves
        $sql = "SELECT * FROM epreuves";
        $stmt = $this->pdo->query($sql);
        // Return the result of the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    public function update($data)
    {
        // Hydrate the object with the data
        $this->hydrate($data);

        // Prepare the SQL query
        $query = "UPDATE epreuves SET 
              libepr = :libepr,
              ensepr = :ensepr,
              matepr = :matepr,
              datepr = :datepr,
              coefepr = :coefepr,
              annepr = :annepr
              WHERE numepr = :numepr";
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the query
        $stmt->bindParam(':numepr', $data['numepr'], PDO::PARAM_INT);
        $stmt->bindParam(':libepr', $data['libepr'], PDO::PARAM_STR);
        $stmt->bindParam(':ensepr', $data['ensepr'], PDO::PARAM_STR);
        $stmt->bindParam(':matepr', $data['matepr'], PDO::PARAM_STR);
        $stmt->bindParam(':datepr', $data['datepr'], PDO::PARAM_STR);
        $stmt->bindParam(':coefepr', $data['coefepr'], PDO::PARAM_INT);
        $stmt->bindParam(':annepr', $data['annepr'], PDO::PARAM_INT);

        // Execute the query
        $result = $stmt->execute();

        // Return the result
        return $result; 
    }
    */


    // Update the data in the database
    public function update($data)
    {
        // Hydrate the data
        $this->hydrate($data);

        // Prepare the query
        $query = "SELECT modif_epreuve(:numepr, :libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr)";
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the query
        $stmt->bindParam(':numepr', $data['numepr'], PDO::PARAM_INT);
        $stmt->bindParam(':libepr', $data['libepr'], PDO::PARAM_STR);
        $stmt->bindParam(':ensepr', $data['ensepr'], PDO::PARAM_STR);
        $stmt->bindParam(':matepr', $data['matepr'], PDO::PARAM_STR);
        $stmt->bindParam(':datepr', $data['datepr'], PDO::PARAM_STR);
        $stmt->bindParam(':coefepr', $data['coefepr'], PDO::PARAM_INT);
        $stmt->bindParam(':annepr', $data['annepr'], PDO::PARAM_INT);

        // Execute the query
        $result = $stmt->execute();

        // Return the result
        return $result;
    }

    // Delete the data from the database
    public function delete($numepr)
    {
        try {
            // Begin a transaction
            $this->pdo->beginTransaction();

            // Prepare the query
            $sql = "DELETE FROM epreuves WHERE numepr = :numepr";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);

            // Execute the query
            if (!$stmt->execute()) {
                // Throw an exception if the query fails
                throw new Exception("Erreur lors de la suppression de l'épreuve.");
            }

            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Erreur : " . htmlspecialchars($e->getMessage()) . "
        </div>";
            return false;
        }
    }

    /*
    public function getClassement($numepr)
    {
        // Prepare a SQL statement to select the student's number, name, surname, note and average note
        $stmt = $this->pdo->prepare("
            SELECT 
                etu.numetu,
                etu.nometu AS nom,
                etu.prenometu AS prenom,
                anote.note,
                ROUND(AVG(anote.note) OVER (PARTITION BY etu.numetu), 2) AS moyenne_globale
            FROM 
                avoir_note anote
            JOIN 
                etudiants etu 
            ON 
                anote.numetu = etu.numetu
            WHERE 
                anote.numepr = :numepr
            ORDER BY 
                anote.note DESC
        ");
        // Execute the SQL statement with the given parameter
        $stmt->execute([':numepr' => $numepr]);

        // Return the result of the SQL statement
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        */

    //This function retrieves the ranking of a given competition
    public function getClassement($numepr)
    {
        //Prepare a SQL statement to select all data from the get_classement_par_epreuve function, passing in the competition number as a parameter
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_par_epreuve(:numepr)");
        //Execute the SQL statement, passing in the competition number as a parameter
        $stmt->execute([':numepr' => $numepr]);

        //Return the results of the SQL statement as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Getters 

    public function getPdo(): object
    {
        return $this->pdo;
    }

    public function getnumepr(): int
    {
        return $this->numepr;
    }

    public function getensepr(): string
    {
        return $this->ensepr;
    }

    public function getlibepr(): string
    {
        return $this->libepr;
    }

    public function getmatepr(): string
    {
        return $this->matepr;
    }

    public function getdatepr(): string
    {
        return $this->datepr;
    }

    public function getcoefepr(): int
    {
        return $this->coefepr;
    }

    public function getannepr(): int
    {
        return $this->annepr;
    }

    // Setters

    public function setPdo(object $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function setnumepr(int $numepr): void
    {
        $this->numepr = $numepr;
    }

    public function setensepr(string $ensepr): void
    {
        $this->ensepr = $ensepr;
    }

    public function setlibepr(string $libepr): void
    {
        $this->libepr = $libepr;
    }

    public function setmatepr(string $matepr): void
    {
        $this->matepr = $matepr;
    }

    public function setdatepr(string $datepr): void
    {
        $this->datepr = $datepr;
    }

    public function setcoefepr(int $coefepr): void
    {
        $this->coefepr = $coefepr;
    }

    public function setannepr(int $annepr): void
    {
        $this->annepr = $annepr;
    }

}
