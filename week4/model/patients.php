<?php

//provides a wrapper to the database
class Patients{

    private $patientData;

    public function __construct($configFile){

        if ($ini = parse_ini_file($configFile)){
            
            $patientPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

            //dont emulate prepare statements
            $patientPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throw exceptions if there is a database error
            $patientPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set our database to be newly created PDO
            $this->patientData = $patientPDO;
        }
        else{
            //things didnt go well, trow exception
            throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
        }
    }//end constructor

    
    // Get listing of all patients
    public function getPatients () {
        $results = [];
        $patientTable = $this->patientData;

        $stmt = $patientTable->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY patientLastName"); 
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

    //Add a patient to database
    public function addPatient ($patientFirstName, $patientLastName, $patientMarried, $patientBirthDate) {
        $addSuccessful = false;
        $patientTable = $this->patientData;

        $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate");

        $boundParams = array(
            ":patientFirstName" => $patientFirstName,
            ":patientLastName" => $patientLastName,
            ":patientMarried" => $patientMarried,
            ":patientBirthDate" => $patientBirthDate
        );
        
        $addSuccessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
        return $addSuccessful;
    }
   
    // Alternative style to add team records database.
    //keeping for notes
    // function addTeam2 ($team, $division) {
    //     global $db;
    //     $results = "Not added";

    //     $stmt = $db->prepare("INSERT INTO teams SET teamName = :team, division = :division");
       
    //     $stmt->bindValue(':team', $team);
    //     $stmt->bindValue(':division', $division);
       
    //     if ($stmt->execute() && $stmt->rowCount() > 0) {
    //         $results = 'Data Added';
    //     }
       
    //     $stmt->closeCursor();
       
    //     return ($results);
    // }
   
    //   $result = addTeam2 ('Ajax', 'Eredivisie');
    //   echo $result;


//update function to update the table into the database
    public function updatePatient ($id, $patientFirstName, $patientLastName, $patientMarried, $patientBirthDate)
    {
        $updateSuccessful = false;
        $patientTable = $this->patientData;
        
        $stmt = $patientTable->prepare("UPDATE patients SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate WHERE id = :id");

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':patientFirstName', $patientFirstName);
        $stmt->bindValue(':patientLastName', $patientLastName);
        $stmt->bindValue(':patientMarried', $patientMarried);
        $stmt->bindValue(':patientBirthDate', $patientBirthDate);

        $updateSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);
        
        return $updateSuccessful;
    }


//Delete function to delete a patient from the database
    public function deletePatient ($id)
    {
        $deleteSuccessful = false;
        $patientTable = $this->patientData;

        $stmt = $patientTable->prepare("DELETE FROM patients WHERE id = :id");

        $stmt->bindValue(':id', $id);

        $deleteSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);

        return $deleteSuccessful;
    }


//Get listing of patient
    public function getPatient ($id)
    {
        $results = [];
        $patientTable = $this->patientData;

        $stmt = $patientTable->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id = :id");

        $stmt->bindValue(':id', $id);

        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    //special function accessible to derived classes
    //allows children to make queries to the database
    protected function getDatabaseRef()
    {
        return $this->patientData;
    }

}//end patient class

   

?>
