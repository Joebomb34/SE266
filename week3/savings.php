<?php

include_once "account.php";
 
    class SavingsAccount extends Account 
    {
        protected $saving_ID;
        protected $saving_bal;
        protected $date;
        public function __construct ($id, $bal, $dt) 
        {
           $this->saving_ID = $id;
           $this->saving_bal = $bal;
           $this->date = $dt;

           parent::__construct($id,$bal,$dt);
        } // end constructor

        public function withdrawal($amount) 
        {
            if ($this->saving_bal - $amount >= 0){

                return true;
            }else{
                return false;
            }
        } //end withdrawal

        public function getAccountDetails() 
        {
            $accountDetails = "<h2>Savings Account</h2>";
            $accountDetails = parent::getAccountDetails();
            
            return $accountDetails;
        } //end getAccountDetails
        
    } // end Savings
?>
