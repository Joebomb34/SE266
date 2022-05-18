<?php

include_once __DIR__ . '/cars.php';

// Extending the class to use the other file
class CarSearch extends Cars
{

    // Allows user to search
    function searchCars ($carYear, $carMake, $carModel, $carTrans, $carColor) 
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
        // if the user has input, then append the value and bind the parameter
        if ($carYear != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  carYear LIKE :carYear";
            $binds['carYear'] = '%'.$carYear.'%';
        }


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
        
        if ($carTrans != ""){
            if ($isFirstClause){
                $sqlQuery .= " WHERE ";
                $isFirstClause = false;
            }
            else{
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= " carTrans LIKE :carTrans";
            $binds['carTrans'] = '%'.$carTrans.'%';
        }

        if ($carColor != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  carColor LIKE :carColor";
            $binds['carColor'] = '%'.$carColor.'%';
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