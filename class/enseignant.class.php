<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Using CodeGeeX Ia for documentation

/**
 * Class representing a teacher.
 *
 * @package MyApp
 * @author Alexis Demol
 */
class Enseignant
{
    // Declare private variables
    private object $pdo;
    private int $numens;
    private string $nomens;
    private string $preens;
    private string $foncens;
    private string $adrens;
    private string $vilens;
    private int $cpens;
    private string $telens;
    private string $datnaiens;
    private string $datembens;


    // Constructor function
    public function __construct($pdo, $data = [])
    {
        $this->pdo = $pdo;
        $this->numens = 0;
        $this->nomens = 'Non spécifié';
        $this->preens = 'Non spécifié';
        $this->foncens = 'Non spécifié';
        $this->adrens = 'Non spécifié';
        $this->cpens = 62100;
        $this->vilens = 'Non spécifié';
        $this->datnaiens = 'Non spécifié';
        $this->datembens = 'Non spécifié';
        $this->telens = 'Non spécifié';

        // If data is not empty, call the hydrate function
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    // Hydrate function to set the values of the private variables
    public function hydrate($data)
    {

        // Check if numens is numeric and not empty, if so set the value
        if (!empty($data['numens']) && is_numeric($data['numens'])) {
            $this->numens = (int) $data['numens'];
        } else {
            $this->numens = 0;
        }

        // Check if nomens is not empty, if so set the value
        if (!empty($data['nomens'])) {
            $this->nomens = $data['nomens'];
        } else {
            $this->nomens = '';
        }

        // Check if preens is not empty, if so set the value
        if (!empty($data['preens'])) {
            $this->preens = $data['preens'];
        } else {
            $this->preens = '';
        }
    
        // Check if foncens is not empty, if so set the value
        if (!empty($data['foncens'])) {
            $this->foncens = $data['foncens'];
        } else {
            $this->foncens = '';
        }
        
        // Check if adrens is not empty, if so set the value
        if (!empty($data['adrens'])) {
            $this->adrens = $data['adrens'];
        } else {
            $this->adrens = '';
        }

        // Check if cpens is numeric and not empty, if so set the value
        if (!empty($data['cpens']) && is_numeric($data['cpens']) && strlen((string) $data['cpens']) == 5) {
            $this->cpens = (int) $data['cpens'];
        } else {
            $this->cpens = 0;
        }

        // Check if vilens is not empty, if so set the value
        if (!empty($data['vilens'])) {
            $this->vilens = $data['vilens'];
        } else {
            $this->vilens = '';
        }

        // Check if datnaiens is not empty, if so set the value
        if (!empty($data['datnaiens'])) {
            $this->datnaiens = $data['datnaiens'];
        } else {
            $this->datnaiens = '';
        }

        // Check if datembens is not empty, if so set the value
        if (!empty($data['datembens'])) {
            $this->datembens = $data['datembens'];
        } else {
            $this->datembens = '';
        }

        // Check if telens is not empty, if so set the value
        if (!empty($data['telens'])) {
            $this->telens = $data['telens'];
        } else {
            $this->telens = '';
        }
    }

    // Function to validate the input data
    public function validate()
    {
        // Initialize an empty array to store errors
        $errors = [];

        // Check if the teacher number is empty
        if (empty($this->numens)) {
            $errors[] = "Le numéro enseignant est obligatoire.";
        }

        // Check if the teacher's name is empty
        if (empty($this->nomens)) {
            $errors[] = "Le nom est obligatoire.";
        }

        // Check if the teacher's first name is empty
        if (empty($this->preens)) {
            $errors[] = "Le prénom est obligatoire.";
        }

        // Check if the teacher's function is empty
        if (empty($this->foncens)) {
            $errors[] = "La fonction est obligatoire.";
        }

        // Check if the teacher's birth date is empty
        if (empty($this->datnaiens)) {
            $errors[] = "La date de naissance est obligatoire.";
        }

        // Check if the teacher's postal code is empty, not a number or not 5 digits long
        if (empty($this->cpens) || !is_numeric($this->cpens) || strlen((string) $this->cpens) != 5) {
            $errors[] = "Le code postal doit avoir exactement 5 chiffres et être un nombre valide.";
        }

        // Check if the teacher's address is empty
        if (empty($this->adrens)) {
            $errors[] = "L'adresse est obligatoire.";
        }

        // Check if the teacher's city is empty
        if (empty($this->vilens)) {
            $errors[] = "La ville est obligatoire.";
        }

        // Check if the teacher's hire date is empty
        if (empty($this->datembens)) {
            $errors[] = "La date d'embauche est obligatoire.";
        }
        
        // Check if the teacher's phone number is empty or not a number
        if (empty($this->telens) || !is_numeric($this->telens)) {
            $errors[] = "Le numéro de téléphone doit être un nombre valide et il est obligatoire.";
        }


        // If there are any errors, display them
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
    public function create()
    {
        // Check if the form data is valid
        if (!$this->validate()) {
            return false;
        }

        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL statement
            $sql = "INSERT INTO enseignants (numens, nomens, preens, foncens, adrens, vilens, cpens, telens, datnaiens, datembens)
                VALUES (:numens, :nomens, :preens, :foncens, :adrens, :vilens, :cpens, :telens, :datnaiens, :datembens)";

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameters to the statement
            $stmt->bindParam(':numens', $this->numens, PDO::PARAM_INT);
            $stmt->bindParam(':nomens', $this->nomens, PDO::PARAM_STR);
            $stmt->bindParam(':preens', $this->preens, PDO::PARAM_STR);
            $stmt->bindParam(':foncens', $this->foncens, PDO::PARAM_STR);
            $stmt->bindParam(':adrens', $this->adrens, PDO::PARAM_STR);
            $stmt->bindParam(':vilens', $this->vilens, PDO::PARAM_STR);
            $stmt->bindParam(':cpens', $this->cpens, PDO::PARAM_INT);
            $stmt->bindParam(':telens', $this->telens, PDO::PARAM_INT);
            $stmt->bindParam(':datnaiens', $this->datnaiens, PDO::PARAM_STR);
            $stmt->bindParam(':datembens', $this->datembens, PDO::PARAM_STR);

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de l'insertion dans enseignants : " . implode(', ', $stmt->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction
            $this->pdo->rollBack();
            // Check if the error code is 23000 (duplicate entry)
            if ($e->getCode() == 23000) {
                echo "<div class='alertbox errorbox'>
                <span class='closebtn'>&times;</span>
                Le numéro enseignant que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
                </div>";
            } else {
                echo "<div class='alertbox errorbox'>
                <span class='closebtn'>&times;</span>
                Une erreur est survenue lors de la création de l'enseignant. Veuillez réessayer plus tard. <br>
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

            // Prepare the SQL statement to insert a new teacher
            $sql_enseignant = "CALL ajout_enseignant(:numens, :nomens, :preens, :foncens, :adrens, :vilens, :cpens, :telens, :datnaiens, :datembens)";

            // Prepare the statement
            $stmt_enseignant = $this->pdo->prepare($sql_enseignant);
            // Bind the parameters to the statement
            $stmt_enseignant->bindParam(':numens', $this->numens, PDO::PARAM_INT);
            $stmt_enseignant->bindParam(':nomens', $this->nomens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':preens', $this->preens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':foncens', $this->foncens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':adrens', $this->adrens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':vilens', $this->vilens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':cpens', $this->cpens, PDO::PARAM_INT);
            $stmt_enseignant->bindParam(':telens', $this->telens, PDO::PARAM_INT);
            $stmt_enseignant->bindParam(':datnaiens', $this->datnaiens, PDO::PARAM_STR);
            $stmt_enseignant->bindParam(':datembens', $this->datembens, PDO::PARAM_STR);

            // Execute the statement
            if (!$stmt_enseignant->execute()) {
                // If the statement fails, throw an exception
                throw new Exception("Erreur lors de l'insertion dans enseignants : " . implode(', ', $stmt_enseignant->errorInfo()));
            }

            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction if an exception is thrown
            $this->pdo->rollBack();
            if ($e->getCode() == 23000) {
                echo "<div class='alertbox errorbox'>
                    <span class='closebtn'>&times;</span>
                    Le numéro enseignant que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
                    </div>";
            } else {
                echo "<div class='alertbox errorbox'>
                    <span class='closebtn'>&times;</span>
                    Une erreur est survenue lors de la création de l'enseignant. Veuillez réessayer plus tard. <br>
                    </div>";
            }

            return false;
        }
    }

    /*
    // This function fetches data from the database based on the numens parameter
    public function fetch($numens)
    {
        // Prepare the SQL query to select all data from the enseignants table where numens matches the parameter
        $query = 'SELECT * FROM enseignants WHERE numens = :numens';
        $stmt = $this->pdo->prepare($query);
        // Bind the numens parameter to the SQL query
        $stmt->bindParam(':numens', $numens, PDO::PARAM_INT);

        try {
            // Execute the SQL query
            $stmt->execute();
            // Fetch the data from the database and store it in the $data variable
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // If data is found, hydrate the object with the data and return the object
            if ($data) {
                $this->hydrate($data);  
                return $this;
            // If no data is found, return null
            } else {
                return null; 
            }
        // If an error occurs during the execution of the query, throw a RuntimeException
        } catch (PDOException $e) {
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
    */

    // Fetches an enseignant from the database based on the numens parameter
    public function fetch($numens)
    {
        // Prepare the SQL query to fetch the enseignant based on the numens parameter
        $query = 'SELECT * FROM fetch_enseignant(:numens)';
        $stmt = $this->pdo->prepare($query);
        // Bind the numens parameter to the SQL query
        $stmt->bindParam(':numens', $numens, PDO::PARAM_INT);

        try {
            // Execute the SQL query
            $stmt->execute();
            // Fetch the data from the SQL query
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


    // Finds an enseignant from the database based on the criteria parameter
    public function find($criteria)
    {
        // Prepare the SQL query to find the enseignant based on the criteria parameter
        $sql = "SELECT * FROM enseignants WHERE nomens LIKE :nom";
        $stmt = $this->pdo->prepare($sql);

        // Bind the criteria parameter to the SQL query
        $stmt->bindValue(':nom', '%' . $criteria['nomens'] . '%', PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch all the teachers from the database
    public function fetchAll(): array
    {
        $sql = "SELECT * FROM enseignants";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /*
    public function update($data)
    {
        // Hydrate the object with the data
        $this->hydrate($data);

        try {
            // Prepare the SQL query
            $sql = "UPDATE enseignants
                SET 
                    nomens = :nomens,
                    preens = :preens,
                    foncens = :foncens,
                    adrens = :adrens,
                    vilens = :vilens,
                    cpens = :cpens,
                    telens = :telens,
                    datnaiens = :datnaiens,
                    datembens = :datembens
                WHERE numens = :numens";

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);

            // Bind the parameters to the statement
            $stmt->bindParam(':numens', $data['numens'], PDO::PARAM_INT);
            $stmt->bindParam(':nomens', $data['nomens'], PDO::PARAM_STR);
            $stmt->bindParam(':preens', $data['preens'], PDO::PARAM_STR);
            $stmt->bindParam(':foncens', $data['foncens'], PDO::PARAM_STR);
            $stmt->bindParam(':adrens', $data['adrens'], PDO::PARAM_STR);
            $stmt->bindParam(':vilens', $data['vilens'], PDO::PARAM_STR);
            $stmt->bindParam(':cpens', $data['cpens'], PDO::PARAM_INT);
            $stmt->bindParam(':telens', $data['telens'], PDO::PARAM_STR);
            $stmt->bindParam(':datnaiens', $data['datnaiens'], PDO::PARAM_STR);
            $stmt->bindParam(':datembens', $data['datembens'], PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            return true; 
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false; 
        }
    }
        */


    // Update the teacher's data
    public function update($data)
    {
        // Hydrate the teacher's data
        $this->hydrate($data);

        try {
            // Prepare the SQL query
            $sql = "SELECT modif_enseignant(
            :numens,
            :nomens,
            :preens,
            :foncens,
            :adrens,
            :vilens,
            :cpens,
            :telens,
            :datnaiens,
            :datembens
        )";

            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);
            // Bind the parameters to the statement
            $stmt->bindParam(':numens', $data['numens'], PDO::PARAM_INT);
            $stmt->bindParam(':nomens', $data['nomens'], PDO::PARAM_STR);
            $stmt->bindParam(':preens', $data['preens'], PDO::PARAM_STR);
            $stmt->bindParam(':foncens', $data['foncens'], PDO::PARAM_STR);
            $stmt->bindParam(':adrens', $data['adrens'], PDO::PARAM_STR);
            $stmt->bindParam(':vilens', $data['vilens'], PDO::PARAM_STR);
            $stmt->bindParam(':cpens', $data['cpens'], PDO::PARAM_INT);
            $stmt->bindParam(':telens', $data['telens'], PDO::PARAM_STR);
            $stmt->bindParam(':datnaiens', $data['datnaiens'], PDO::PARAM_STR);
            $stmt->bindParam(':datembens', $data['datembens'], PDO::PARAM_STR);
            // Execute the statement
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    public function delete($numens)
    {
        try {
            $this->pdo->beginTransaction();

            // Delete the record from the enseignants table
            $sql = "DELETE FROM enseignants WHERE numens = :numens";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':numens', $numens, PDO::PARAM_INT);

            // Check if the deletion was successful
            if (!$stmt->execute()) {
                throw new Exception("Erreur lors de la suppression de l'étudiant dans enseignants.");
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    // Getters 

    public function getPdo(): object
    {
        // Return the pdo property
        return $this->pdo;
    }

    public function getnumens(): int
    {
        // Return the numens property
        return $this->numens;
    }

    public function getnomens(): string
    {
        // Return the nomens property
        return $this->nomens;
    }

    public function getpreens(): string
    {
        // Return the preens property
        return $this->preens;
    }

    public function getfoncens(): string
    {
        // Return the foncens property
        return $this->foncens;
    }

    public function getadrens(): string
    {
        // Return the adrens property
        return $this->adrens;
    }

    public function getvilens(): string
    {
        // Return the vilens property
        return $this->vilens;
    }

    public function getcpens(): int
    {
        // Return the cpens property
        return $this->cpens;
    }

    public function gettelens(): string
    {
        // Return the telens property
        return $this->telens;
    }

    public function getdatnaiens(): string
    {
        // Return the datnaiens property
        return $this->datnaiens;
    }

    public function getdatembens(): string
    {
        // Return the datembens property
        return $this->datembens;
    }

    // Setters

    public function setPdo(object $pdo): void
    {
        // Set the pdo property
        $this->pdo = $pdo;
    }

    public function setnumens(int $numens): void
    {
        // Set the numens property
        $this->numens = $numens;
    }

    public function setnomens(string $nomens): void
    {
        // Set the nomens property
        $this->nomens = $nomens;
    }

    public function setpreens(string $preens): void
    {
        // Set the preens property
        $this->preens = $preens;
    }

    public function setdatnaiens(string $datnaiens): void
    {
        // Set the datnaiens property
        $this->datnaiens = $datnaiens;
    }

    public function setadrens(string $adrens): void
    {
        // Set the adrens property
        $this->adrens = $adrens;
    }

    public function setcpens(int $cpens): void
    {
        // Set the cpens property
        $this->cpens = $cpens;
    }

    public function setvilens(string $vilens): void
    {
        // Set the vilens property
        $this->vilens = $vilens;
    }

    public function settelens(string $telens): void
    {
        // Set the telens property
        $this->telens = $telens;
    }

    public function setfoncens(string $foncens): void
    {
        // Set the foncens property
        $this->foncens = $foncens;
    }

    public function setdatembens(string $datembens): void
    {
        // Set the datembens property
        $this->datembens = $datembens;
    }
}
