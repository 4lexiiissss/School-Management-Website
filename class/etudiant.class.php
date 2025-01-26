<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Using CodeGeeX Ia for documentation

/**
 * Class representing a students.
 *
 * @package MyApp
 * @author Alexis Demol
 */
class Etudiant
{
    // Declare private variables
    private object $pdo;
    private int $numetu;
    private string $nometu;
    private string $prenometu;
    private string $adretu;
    private string $viletu;
    private int $cpetu;
    private int $teletu;
    private string $datentetu;
    private int $annetu;
    private string $remetu;
    private string $sexetu;
    private string $datnaietu;


    // Constructor
    public function __construct($pdo, $data = [])
    {
        $this->pdo = $pdo;
        // Initialize variables
        $this->numetu = 0;
        $this->nometu = '';
        $this->prenometu = '';
        $this->adretu = '';
        $this->viletu = '';
        $this->cpetu = 0;
        $this->teletu = 0;
        $this->datentetu = '';
        $this->annetu = 0;
        $this->remetu = '';
        $this->sexetu = '';
        $this->datnaietu = '';


        // If data is not empty, call the hydrate function
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    // Hydrate function
    public function hydrate($data)
    {

        // Check if numetu is numeric and not empty, if so set it to the value of numetu
        if (!empty($data['numetu']) && is_numeric($data['numetu'])) {
            $this->numetu = (int) $data['numetu'];
        } else {
            $this->numetu = 0;
        }

        // Check if nometu is not empty, if so set it to the value of nometu
        if (!empty($data['nometu'])) {
            $this->nometu = $data['nometu'];
        } else {
            $this->nometu = '';
        }

        // Check if prenometu is not empty, if so set it to the value of prenometu
        if (!empty($data['prenometu'])) {
            $this->prenometu = $data['prenometu'];
        } else {
            $this->prenometu = '';
        }
    
        // Check if adretu is not empty, if so set it to the value of adretu
        if (!empty($data['adretu'])) {
            $this->adretu = $data['adretu'];
        } else {
            $this->adretu = '';
        }
        
        // Check if viletu is not empty, if so set it to the value of viletu
        if (!empty($data['viletu'])) {
            $this->viletu = $data['viletu'];
        } else {
            $this->viletu = '';
        }
        
        // Check if cpetu is numeric and not empty, if so set it to the value of cpetu
        if (!empty($data['cpetu']) && is_numeric($data['cpetu']) && strlen((string) $data['cpetu']) == 5) {
            $this->cpetu = (int) $data['cpetu'];
        } else {
            $this->cpetu = 0;
        }
        
        // Check if teletu is numeric and not empty, if so set it to the value of teletu
        if (!empty($data['teletu']) && is_numeric($data['teletu'])) {
            $this->teletu = (int) $data['teletu'];
        } else {
            $this->teletu = 0;
        }
        
        // Check if datentetu is not empty, if so set it to the value of datentetu
        if (!empty($data['datentetu'])) {
            $this->datentetu = $data['datentetu'];
        } else {
            $this->datentetu = '';
        }
        
        // Check if annetu is numeric and not empty, if so set it to the value of annetu
        if (!empty($data['annetu']) && is_numeric($data['annetu'])) {
            $this->annetu = (int) $data['annetu'];
        } else {
            $this->annetu = 0;
        }
        
        // Check if remetu is not empty, if so set it to the value of remetu
        if (!empty($data['remetu'])) {
            $this->remetu = $data['remetu'];
        } else {
            $this->remetu = '';
        }
        
        // Check if sexetu is not empty, if so set it to the value of sexetu
        if (!empty($data['sexetu'])) {
            $this->sexetu = $data['sexetu'];
        } else {
            $this->sexetu = '';
        }
    
        // Check if datnaietu is not empty, if so set it to the value of datnaietu
        if (!empty($data['datnaietu'])) {
            $this->datnaietu = $data['datnaietu'];
        } else {
            $this->datnaietu = '';
        }
    }

    public function validate()
    {
        // Initialize an empty array to store any errors
        $errors = [];

        // Check if the student number is empty, not numeric, or not exactly 8 characters long
        if (empty($this->numetu) || !is_numeric($this->numetu) || strlen((string) $this->numetu) != 8) {
             
            // Add an error message to the array
            $errors[] = "Le numéro étudiant est obligatoire et doit comporter exactement 8 chiffres.";
        }

        // Check if the name is empty
        if (empty($this->nometu)) {
             
            // Add an error message to the array
            $errors[] = "Le nom est obligatoire.";
        }

        // Check if the first name is empty
        if (empty($this->prenometu)) {
             
            // Add an error message to the array
            $errors[] = "Le prénom est obligatoire.";
        }
        
        // Check if the date of birth is empty
        if (empty($this->datnaietu)) {
             
            // Add an error message to the array
            $errors[] = "La date de naissance est obligatoire.";
        }
    
        // Check if the address is empty
        if (empty($this->adretu)) {
             
            // Add an error message to the array
            $errors[] = "L'adresse est obligatoire.";
        }
        
        // Check if the city is empty
        if (empty($this->viletu)) {
             
            // Add an error message to the array
            $errors[] = "La ville est obligatoire.";
        }
        
        // Check if the postal code is empty, not numeric, or not exactly 5 characters long
        if (empty($this->cpetu) || !is_numeric($this->cpetu) || strlen((string) $this->cpetu) != 5) {
             
            // Add an error message to the array
            $errors[] = "Le code postal doit avoir exactement 5 chiffres et être un nombre valide.";
        }
        // Check if the phone number is empty or not numeric
        if (empty($this->teletu || !is_numeric($this->teletu || strlen((string) $this->teletu) != 10))) {
             
            // Add an error message to the array
            $errors[] = "Le numéro de téléphone est obligatoire.";
        }
        // Check if the date of entry is empty
        if (empty($this->datentetu)) {
             
            // Add an error message to the errors array
            $errors[] = "La date d'entré est obligatoire.";
        }
        
        // Check if the year is empty or not a number
        if (empty($this->annetu || !is_numeric($this->annetu))) {
             
            // Add an error message to the errors array
            $errors[] = "L'année est obligatoire.";
        }
        // Check if the sex is empty
        if (empty($this->sexetu)) {
             
            // Add an error message to the errors array
            $errors[] = "Le sexe est obligatoire.";
        }
        // Check if the date of birth is empty
        if (empty($this->datnaietu)) {
             
            // Add an error message to the errors array
            $errors[] = "La date de naissance est obligatoire.";
        }

        // Check if there are any errors
        if (!empty($errors)) {
            // Display the error messages
            echo '<div class="alertbox errorbox">';
            foreach ($errors as $error) {
                echo '<div>' . htmlspecialchars($error) .
                    '<span class="closebtn">&times;</span></div>';
            }
            echo '</div>';

            // Return false if there are errors
            return false; 
        }

        // Return true if there are no errors
        return true;

    }

    /*
    public function create() {
        // Check if the form is valid
        if (!$this->validate()) {
            return false;
        }
    
        try {
            // Start a transaction
            $this->pdo->beginTransaction();
    
            // SQL query to insert a new student into the database
            $sql_etudiant = "
                INSERT INTO etudiants (
                    numetu, nometu, prenometu, adretu, viletu, cpetu, teletu, datentetu, annetu, remetu, sexetu, datnaietu
                )
                VALUES (
                    :numetu, :nometu, :prenometu, :adretu, :viletu, :cpetu, :teletu, :datentetu, :annetu, :remetu, :sexetu, :datnaietu
                );
            ";
    
            // Prepare the SQL query
            $stmt_etudiant = $this->pdo->prepare($sql_etudiant);
    
            // Bind the parameters to the SQL query
            $stmt_etudiant->bindParam(':numetu', $this->numetu, PDO::PARAM_INT); 
            $stmt_etudiant->bindParam(':nometu', $this->nometu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':prenometu', $this->prenometu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':adretu', $this->adretu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':viletu', $this->viletu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':cpetu', $this->cpetu, PDO::PARAM_INT); 
            $stmt_etudiant->bindParam(':teletu', $this->teletu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':datentetu', $this->datentetu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':annetu', $this->annetu, PDO::PARAM_INT); 
            $stmt_etudiant->bindParam(':remetu', $this->remetu, PDO::PARAM_STR); 
            $stmt_etudiant->bindParam(':sexetu', $this->sexetu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':datnaietu', $this->datnaietu, PDO::PARAM_STR); 
    
            // Execute the SQL query
            if (!$stmt_etudiant->execute()) {
                // If the query fails, throw an exception
                $errorInfo = $stmt_etudiant->errorInfo();
                throw new Exception("Erreur SQL: " . $errorInfo[2]);
            }
    
            // Commit the transaction
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // If an exception is thrown, roll back the transaction
            $this->pdo->rollBack();
            echo "<div class='alertbox errorbox'>
                    <span class='closebtn'>&times;</span>
                    Erreur lors de l'insertion : " . $e->getMessage() . "<br>
                </div>";
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

            // Prepare the SQL statement to insert a new student
            $sql_etudiant = "CALL ajout_etudiant(:numetu, :nometu, :prenometu, :adretu, :viletu, :cpetu, :teletu, :datentetu, :annetu, :remetu, :sexetu, :datnaietu)";

            // Prepare the statement
            $stmt_etudiant = $this->pdo->prepare($sql_etudiant);
            // Bind the parameters to the statement
            $stmt_etudiant->bindParam(':numetu', $this->numetu, PDO::PARAM_INT);
            $stmt_etudiant->bindParam(':nometu', $this->nometu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':prenometu', $this->prenometu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':adretu', $this->adretu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':viletu', $this->viletu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':cpetu', $this->cpetu, PDO::PARAM_INT);
            $stmt_etudiant->bindParam(':teletu', $this->teletu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':datentetu', $this->datentetu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':annetu', $this->annetu, PDO::PARAM_INT);
            $stmt_etudiant->bindParam(':remetu', $this->remetu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':sexetu', $this->sexetu, PDO::PARAM_STR);
            $stmt_etudiant->bindParam(':datnaietu', $this->datnaietu, PDO::PARAM_STR);

            // Execute the statement
            if (!$stmt_etudiant->execute()) {
                throw new Exception("Erreur lors de l'insertion dans etudiants : " . implode(', ', $stmt_etudiant->errorInfo()));
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            if ($e->getCode() == 23000) {

                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Le numéro étudiant que vous avez choisi est déjà utilisé. Veuillez en choisir un autre. <br>
            </div>";

            } else {
                echo "<div class='alertbox errorbox'>
            <span class='closebtn'>&times;</span>
            Une erreur est survenue lors de la création de l'étudiant. Veuillez réessayer plus tard. <br>
            </div>";
            }

            return false;
        }
    }

    /*
    //This function fetches a student from the database based on their student number
    public function fetch($numetu)
    {
        //Prepare a SQL query to select all data from the etudiants table where the numetu column matches the given student number
        $query = 'SELECT * FROM etudiants WHERE numetu = :numetu';
        //Prepare the SQL query
        $stmt = $this->pdo->prepare($query);
        //Bind the student number to the SQL query
        $stmt->bindParam(':numetu', $numetu, PDO::PARAM_INT);

        try {
            //Execute the SQL query
            $stmt->execute();
            //Fetch the data from the SQL query
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            //If data is found
            if ($data) {
                //Hydrate the data into the student object
                $this->hydrate($data);
                //Return the student object
                return $this;
            } else {
                //If no data is found, return null
                return null;
            }
        } catch (PDOException $e) {
            //If an error occurs, throw a runtime exception with the error message
            throw new RuntimeException('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
        */


    public function fetch($numetu)
    {
        // Prepare the SQL query to fetch the student data based on the student number
        $query = 'SELECT * FROM fetch_etudiant(:numetu)';
        $stmt = $this->pdo->prepare($query);
        // Bind the student number to the query
        $stmt->bindParam(':numetu', $numetu, PDO::PARAM_INT);

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
        // Prepare the SQL query to find the student data based on the student name
        $sql = "SELECT * FROM etudiants WHERE nometu LIKE :nom";
        $stmt = $this->pdo->prepare($sql);

        // Bind the student name to the query
        $stmt->bindValue(':nom', '%' . $criteria['nometu'] . '%', PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // This function fetches all the data from the 'etudiants' table
    public function fetchAll(): array
    {
        // SQL query to select all data from the 'etudiants' table
        $sql = "SELECT * FROM etudiants";
        // Execute the query and store the result in a statement object
        $stmt = $this->pdo->query($sql);
        // Fetch all the data from the statement object and return it as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
        public function update($data)
        {
            // Hydrate the object with the data passed in
            $this->hydrate($data);

            // Prepare the SQL query to update the student's information
            $query = "UPDATE etudiants 
                  SET nometu = :nometu,
                      prenometu = :prenometu,
                      adretu = :adretu,
                      viletu = :viletu,
                      cpetu = :cpetu,
                      teletu = :teletu,
                      datentetu = :datentetu,
                      annetu = :annetu,
                      remetu = :remetu,
                      sexetu = :sexetu,
                      datnaietu = :datnaietu
                  WHERE numetu = :numetu";

            // Prepare the statement
            $stmt = $this->pdo->prepare($query);

            // Bind the parameters to the statement
            $stmt->bindParam(':numetu', $data['numetu'], PDO::PARAM_INT);
            $stmt->bindParam(':nometu', $data['nometu'], PDO::PARAM_STR);
            $stmt->bindParam(':prenometu', $data['prenometu'], PDO::PARAM_STR);
            $stmt->bindParam(':adretu', $data['adretu'], PDO::PARAM_STR);
            $stmt->bindParam(':viletu', $data['viletu'], PDO::PARAM_STR);
            $stmt->bindParam(':cpetu', $data['cpetu'], PDO::PARAM_STR);
            $stmt->bindParam(':teletu', $data['teletu'], PDO::PARAM_STR);
            $stmt->bindParam(':datentetu', $data['datentetu'], PDO::PARAM_STR);
            $stmt->bindParam(':annetu', $data['annetu'], PDO::PARAM_STR);
            $stmt->bindParam(':remetu', $data['remetu'], PDO::PARAM_STR);
            $stmt->bindParam(':sexetu', $data['sexetu'], PDO::PARAM_STR);
            $stmt->bindParam(':datnaietu', $data['datnaietu'], PDO::PARAM_STR);

            // Execute the statement
            $result = $stmt->execute();
            return $result;
        }
            */


    public function update($data)
    {

        // Hydrate the object with the data passed in
        $this->hydrate($data);

        // Prepare the SQL query to update the student
        $query = "SELECT modif_etudiant(:numetu, :nometu, :prenometu, :adretu, :viletu, :cpetu, :teletu, :datentetu, :annetu, :remetu, :sexetu, :datnaietu)";
        $stmt = $this->pdo->prepare($query);

        // Bind the parameters to the SQL query
        $stmt->bindParam(':numetu', $data['numetu'], PDO::PARAM_INT);
        $stmt->bindParam(':nometu', $data['nometu'], PDO::PARAM_STR);
        $stmt->bindParam(':prenometu', $data['prenometu'], PDO::PARAM_STR);
        $stmt->bindParam(':adretu', $data['adretu'], PDO::PARAM_STR);
        $stmt->bindParam(':viletu', $data['viletu'], PDO::PARAM_STR);
        $stmt->bindParam(':cpetu', $data['cpetu'], PDO::PARAM_STR);
        $stmt->bindParam(':teletu', $data['teletu'], PDO::PARAM_STR);
        $stmt->bindParam(':datentetu', $data['datentetu'], PDO::PARAM_STR);
        $stmt->bindParam(':annetu', $data['annetu'], PDO::PARAM_STR);
        $stmt->bindParam(':remetu', $data['remetu'], PDO::PARAM_STR);
        $stmt->bindParam(':sexetu', $data['sexetu'], PDO::PARAM_STR);
        $stmt->bindParam(':datnaietu', $data['datnaietu'], PDO::PARAM_STR);

        // Execute the SQL query
        $result = $stmt->execute();

        // Return the result
        return $result;
    }


    public function delete($numetu)
    {
        try {
            // Begin a transaction
            $this->pdo->beginTransaction();

            // Prepare the SQL query to delete the student
            $sql = "DELETE FROM etudiants WHERE numetu = :numetu";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':numetu', $numetu, PDO::PARAM_INT);

            // Execute the SQL query
            if (!$stmt->execute()) {
                // If the query fails, throw an exception
                throw new Exception("Erreur lors de la suppression de l'étudiant dans etudiants.");
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
    //This function retrieves the student's class ranking
    public function getClassement($numetu)
    {
        //Prepare a SQL statement to select the module number, module name, and average grade for the student with the given student number
        $stmt = $this->pdo->prepare("
                SELECT 
                    mat.nummod,
                    mod.nommod,  
                    ROUND(AVG(anote.note), 2) AS moyenne
                FROM 
                    avoir_note anote
                JOIN 
                    epreuves epr ON anote.numepr = epr.numepr
                JOIN 
                    matieres mat ON epr.matepr = mat.nummat
                JOIN 
                    modules mod ON mat.nummod = mod.nummod  
                WHERE 
                    anote.numetu = :numetu
                GROUP BY 
                    mat.nummod, mod.nommod  
                ORDER BY 
                    mod.nommod
        ");
        //Execute the SQL statement with the given student number
        $stmt->execute([':numetu' => $numetu]);

        //Return the result of the SQL statement as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    */

    //This function retrieves the ranking of a student based on their student number
    public function getClassement($numetu)
    {
        //Prepare a SQL statement to select all columns from the get_classement_par_etudiant function, passing in the student number as a parameter
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_par_etudiant(:numetu)");
        //Execute the SQL statement, passing in the student number as a parameter
        $stmt->execute([':numetu' => $numetu]);

        //Return the results of the SQL statement as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    //This function retrieves the general ranking of all students based on their year
    function getClassementGeneralParAnnee()
    {
        //Create a SQL statement to select the student number, name, first name, year, and total score of all students
        $sql = "
            SELECT e.numetu, e.nometu, e.prenometu, e.annetu,
                   SUM(an.note * ep.coefepr) AS total_score
            FROM etudiants e
            JOIN avoir_note an ON e.numetu = an.numetu
            JOIN epreuves ep ON an.numepr = ep.numepr
            JOIN matieres m ON ep.matepr = m.nummat
            GROUP BY e.numetu, e.nometu, e.prenometu, e.annetu
            ORDER BY e.annetu, total_score DESC;
        ";

        //Prepare the SQL statement
        $stmt = $this->pdo->prepare($sql);
        //Execute the SQL statement
        $stmt->execute();

        //Return the results of the SQL statement as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        */

    public function getClassementGeneralParAnnee()
    {
        //Prepare a SQL statement to select all columns from the get_classement_general_par_annee function
        $stmt = $this->pdo->prepare("SELECT * FROM get_classement_general_par_annee()");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Getters 

    public function getPdo(): object
    {
        return $this->pdo;
    }

    public function getNumetu(): int
    {
        return $this->numetu;
    }

    public function getprenometu(): string
    {
        return $this->prenometu;
    }

    public function getnometu(): string
    {
        return $this->nometu;
    }

    public function getdatnaietu(): string
    {
        return $this->datnaietu;
    }

    public function getannetu(): int
    {
        return $this->annetu;
    }

    public function getadretu(): string
    {
        return $this->adretu;
    }

    public function getcpetu(): int
    {
        return $this->cpetu;
    }

    public function getviletu(): string
    {
        return $this->viletu;
    }

    public function getTeletu(): string
    {
        return $this->teletu;
    }

    public function getsexetu(): string
    {
        return $this->sexetu;
    }

    public function getdatentre(): string
    {
        return $this->datentetu;
    }
    public function getremarque(): string
    {
        return $this->remetu;
    }

    public function setPdo(object $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function setRowid(int $rowid): void
    {
        $this->rowid = $rowid;
    }

    public function setNumetu(int $numetu): void
    {
        $this->numetu = $numetu;
    }

    public function setprenometu(string $prenometu): void
    {
        $this->prenometu = $prenometu;
    }

    public function setnometu(string $nometu): void
    {
        $this->nometu = $nometu;
    }

    public function setdatnaietu(string $datnaietu): void
    {
        $this->datnaietu = $datnaietu;
    }

    public function setDiploma(string $diploma): void
    {
        $this->diploma = $diploma;
    }

    public function setannetu(int $annetu): void
    {
        $this->annetu = $annetu;
    }

    public function setTd(int $td): void
    {
        $this->td = $td;
    }

    public function setTp(string $tp): void
    {
        $this->tp = $tp;
    }

    public function setadretu(string $adretu): void
    {
        $this->adretu = $adretu;
    }

    public function setcpetu(int $cpetu): void
    {
        $this->cpetu = $cpetu;
    }

    public function setviletu(string $viletu): void
    {
        $this->viletu = $viletu;
    }

}
