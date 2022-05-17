<?php

include_once __DIR__ . '/cars.php';

// Extending the patients class so we can take advantage of work done earlier
class CarSearch extends Cars
{

    // Allows user to search for either first name, last name, married, or birth date
    // INPUT: first name, last name, or married to search for
    function searchCars ($carMake, $carModel, $carPurchase) 
    {
        // Set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $carTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  cars   ";
$isFirstClause = true;
        // If first name is set, append a patient query and bind parameter
        if ($carMake != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  carMake LIKE :carMake";
            $binds['carMake'] = '%'.$carMake.'%';
        }
    
        // If Last name is set, append the First name query and bind parameter
        if ($carModel != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  carModel LIKE :carModel";
            $binds['carModel'] = '%'.$carModel.'%';
        }
        //If Married is set, append the First name, last name query and bind parameter
        if ($carPurchase != ""){
            if ($isFirstClause){
                $sqlQuery .= " WHERE ";
                $isFirstClause = false;
            }
            else{
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= " carPurchase LIKE :carPurchase";
            $binds['carPurchase'] = '%'.$carPurchase.'%';
        }

        // Create query object from the table
        $stmt = $carTable->prepare($sqlQuery);

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