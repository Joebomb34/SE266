<?php

//provides a wrapper to the database
class Cars{

    private $carData;

    public function __construct($configFile){

        if ($ini = parse_ini_file($configFile)){
            
            $carPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

            //dont emulate prepare statements
            $carPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throw exceptions if there is a database error
            $carPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set our database to be newly created PDO
            $this->carData = $carPDO;
        }
        else{
            //things didnt go well, trow exception
            throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
        }
    }//end constructor

    
    // Get listing of all patients
    public function getCars () {
        $results = [];
        $carTable = $this->carData;

        $stmt = $carTable->prepare("SELECT id, carMake, carModel, carPurchase FROM cars ORDER BY carMake"); 
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

    //Add a patient to database
    public function addCar ($carMake, $carModel, $carPurchase) {
        $addSuccessful = false;
        $carTable = $this->carData;

        $stmt = $carTable->prepare("INSERT INTO cars SET carMake = :carMake, carModel = :carModel, carPurchase = :carPurchase");

        $boundParams = array(
            ":carMake" => $carMake,
            ":carModel" => $carModel,
            ":carPurchase" => $carPurchase
        );
        
        $addSuccessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
        return $addSuccessful;
    }
   
  


//update function to update the table into the database
    public function updateCar ($id, $carMake, $carModel, $carPurchase)
    {
        $updateSuccessful = false;
        $carTable = $this->carData;
        
        $stmt = $carTable->prepare("UPDATE cars SET carMake = :carMake, carModel = :carModel, carPurchase = :carPurchase WHERE id = :id");

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':carMake', $carMake);
        $stmt->bindValue(':carModel', $carModel);
        $stmt->bindValue(':carPurchase', $carPurchase);

        $updateSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);
        
        return $updateSuccessful;
    }


//Delete function to delete a patient from the database
    public function deleteCar ($id)
    {
        $deleteSuccessful = false;
        $carTable = $this->carData;

        $stmt = $carTable->prepare("DELETE FROM cars WHERE id = :id");

        $stmt->bindValue(':id', $id);

        $deleteSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);

        return $deleteSuccessful;
    }


//Get listing of patient
    public function getCar ($id)
    {
        $results = [];
        $carTable = $this->carData;

        $stmt = $carTable->prepare("SELECT id, carMake, carModel, carPurchase FROM cars WHERE id = :id");

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
        return $this->carData;
    }

}//end car class

   

?>
