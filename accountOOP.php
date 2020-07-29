<?php
    class Account{
        public $name;
        public $balance;

        public function __construct($name,$balance)
        {
            $this->name=$name;
            $this->balance=$balance;
        }

        public function setName($name){
            $this->name=$name;
        }

        public function getName(){
            return $this->name;
        }
        public function setBalance($bala){
            $this->balance=$bala;
        }

        public function getBalance(){
            return $this->balance;
        }
        function accountInformation()
        {
             echo "<h5>Your Name is {$this->name}.</h5><h5>Your Balance is {$this->balance}.</h5>";
        }

        //for transfer
        public function transfer($account,$amount){
            if($amount <= $this->balance){
                $newb=$account->balance+$amount;
                echo "<h5>Amount Transfer Completely!</h5>";
               // echo $newb;
                $this->balance -= $amount;
                return $newb;
            }else{
                echo "<h5>Amount Exceed!</h5>";
                echo "<h5>Current Balance is ".$this->balance."</h5>";
            }
            
        }

        //for Credit
        function credit($amount):String{
            $this->balance += $amount;
            echo "<h5>Amount Successfully Added.</h5>";
            echo "<h5>New Balance Is ".$this->balance."</h5>";
            return $this->balance;
        }

        //for Debit
        public function debit($amount){
            if($this->balance > $amount){
                $this->balance -= $amount;
                echo "<h5>Amount successfully substracted.</h5>";
                echo "<h5>New Balance Is ".$this->balance."</h5>";
                return $this->balance;
            }else{
                echo "<h5>Amount Is Not Sufficient!</h5>";
            }    
        }

    }

    function fileRead(){   
        $myfile = fopen("accountfile.txt", "r") or die("Unable to open file!");
        $arr=array();                  
        while(!feof($myfile)) {

            $st=fgets($myfile);
            if($st!=""){
                $obj=json_decode($st,true);
                array_push($arr,$obj);
            }
        }    
        fclose($myfile);
    }

    function fileClear(){
        $handle = fopen("accountfile.txt", "w+");
        fwrite($handle , '');
        fclose($handle);
    }

?>
