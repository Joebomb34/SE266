<?php
 
 	include_once "account.php";
    class CheckingAccount extends Account 
    {
        const OVERDRAW_LIMIT = -200;
        protected $checking_ID;
        protected $checking_bal;
        protected $date;

        public function __construct ($id, $bal, $dt) 
        {
           $this->checking_ID = $id;
           $this->checking_bal = $bal;
           $this->date = $dt;

           parent::__construct($id,$bal,$dt);
        } // end constructor


        public function withdrawal($amount) 
        {
            if($this->checking_bal - $amount >= -200){
                return true;
            }else{
                return false;
            }
        } // end withdrawal

        //freebie. I am giving you this code.
        public function getAccountDetails() 
        {
            $accountDetails = "<h2>Checking Account</h2>";
            $accountDetails = parent::getAccountDetails();
            
            return $accountDetails;
        }
    }    
?>