<?php

include_once __DIR__ . '/model/patients.php';

// Extending the patients class so we can take advantage of work done earlier
class PatientSearch extends Patients
{

    // Allows user to search for either first name, last name, married, or birth date
    // INPUT: first name, last name, or married to search for
    function searchPatients ($patientFirstName, $patientLastName, $patientMarried) 
    {
        // Set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $patientTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  patients   ";
$isFirstClause = true;
        // If first name is set, append a patient query and bind parameter
        if ($patientFirstName != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientFirstName LIKE :patientFirstName";
            $binds['patientFirstName'] = '%'.$patientFirstName.'%';
        }
    
        // If Last name is set, append the First name query and bind parameter
        if ($patientLastName != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientLastName LIKE :patientLastName";
            $binds['patientLastName'] = '%'.$patientLastName.'%';
        }
        //If Married is set, append the First name, last name query and bind parameter
        if ($patientMarried != ""){
            if ($isFirstClause){
                $sqlQuery .= " WHERE ";
                $isFirstClause = false;
            }
            else{
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= " patientMarried LIKE :patientMarried";
            $binds['patientMarried'] = '%'.$patientMarried.'%';
        }

        // Create query object from the table
        $stmt = $patientTable->prepare($sqlQuery);

        // Perform query on the database
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return query rows if any match the search
        return $results;
    } // end search
}

?>