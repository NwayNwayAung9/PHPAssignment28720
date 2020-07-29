<!DOCTYPE html>
<html lang="en">
    <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    </head>
    <style>
   html,
body,

.view {
  height: 100%;
}
@media (max-width: 740px) {
  html,
  body,
 
  .view {
    height: 1000px;
  }
}
@media (min-width: 800px) and (max-width: 850px) {
  html,
  body,

  .view {
    height: 650px;
  }
}

</style>
        <body>
       
 <nav class="navbar navbar-expand-md bg-dark navbar-dark  scrolling-navbar">

  <ul class="navbar-nav">
    
    <li class="nav-item">
      <a class="nav-link" href="newAccount.php">New_Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="transferAccount.php">Transfer_Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accountCreditDebit.php">Account_Credit_And_Debit</a>
    </li>
  </ul>
</nav>

<div class="view" style="background-image: url('acc2.jpg');background-repeat: no-repeat; background-size: cover; background-position: center center;">
            
            <div class="container">
          
        <div class="row">
        <div class="col-6">
                        <h2>Create Account</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="name">Account Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Account Name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="balance">Balance Amount</label>
                                <input type="number" class="form-control" id="balance" placeholder="Enter Balance" name="balance">
                            </div>


                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="submit" class="btn btn-primary" name="btnCreate">Create Account</button>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           
                            <button type="submit" class="btn btn-primary" name="btnShow">Show All Account</button>
                        </form>
                    </div>
                
                    <div class="col-6">
        <?php
            
            include 'accountOOP.php';

            //For Create Button
            if(isset($_POST['btnCreate'])){
             
                $name=$_POST['name'];
                $balance=$_POST['balance'];

                $acc=new Account($name,$balance);
                echo "<h5>Your Account Create Successfully!</h5>";
                $acc->accountInformation();
                
                $n = $acc->name;
                $b = $acc->balance;
                
                $arr=array("Name"=>$name,"Balance"=>$balance);
                $res=json_encode($arr);

                $myfile = fopen("accountfile.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $res."\n");
                fclose($myfile);
                
            }
 
            //For Show Account Button
            if(isset($_POST['btnShow'])){
             
                $myfile = fopen("accountfile.txt", "r") or die("Unable to open file!");

                echo "<h3>Result Account Information</h3>";
                echo "<table class=table table-borderless>";
                echo "<thead class=thead-light>";
                echo "<tr>";
                echo "<td style='border:1px solid'  class=font-weight-bolder>Account Name</td>";
                echo "<td style='border:1px solid'  class=font-weight-bolder>Balance Amount</td>";
                echo "</tr>";
               
              
              
                while(!feof($myfile)) {
                    $account=fgets($myfile);
                    if($account!=""){
                        $result=json_decode($account,true);
                        echo "<tr style='border:1px solid'>";
                        array_walk($result,"myfunction");
                        echo "</tr>";
                    }
                }
              
                fclose($myfile);
                echo "</thead>";
                echo "</table>";
              }
              
              function myfunction($value,$key)
              {
                echo "<td style='border:1px solid'>".$value."</td>";
              }
              
         
           
        ?>
         </div>


         </div>
</div>
</div>
        </body>
</html>