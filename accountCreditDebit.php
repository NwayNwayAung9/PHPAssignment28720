<!DOCTYPE html>
<html lang="en">
    <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
    </style>
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
                            <h2>Account Credit & Debit</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                            <div class="form-group">
                            <label for="">Choose Account</label>
                                <select name="account" class="form-control">
                                    <option selected disabled>Choose Account</option>
                                    <?php
                                       $arr=array();
                                       $a=array();
                                    
                                       $myfile = fopen("accountfile.txt", "r") or die("Unable to open file!");
                                        
                                        while(!feof($myfile)) {
                        
                                            $st=fgets($myfile);
                                            if($st!=""){
                                                $obj=json_decode($st,true);
                                            
                                                array_push($arr,$obj);
                                        
                                            }
                                        }
                                        
                                        fclose($myfile);

                                            if(count($arr)>0){
                                                foreach($arr as $arrs){
                                                    array_push($a,$arrs);
                                                }
                                            
                                            }
                                        
                                        for($i=0;$i<count($a);$i++){
                                            $n=$a[$i]["Name"];
                                            echo "<option value='".$n."'>".$n."</option>";
                                        }
                                    ?>
                                </select>

                            </div>

                                <div class="form-group">
                                    <label for="id">Enter Amount</label>
                                    <input type="text" class="form-control" id="amt" placeholder="Enter amount to change balance" name="amt">
                                </div>
                                

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              

                                <button type="submit" class="btn btn-primary" name="credit">Credit Amount</button>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary" name="debit">Debit Amount</button>
                                
                            </form>
                        </div>
                  
                        <div class="col-6">
            <?php
                include 'accountOOP.php';
                //for credit
                if(isset($_POST['credit'])){
                    $acc=$_POST['account'];
                    $amt=$_POST['amt'];

                    fileRead();
                    $a=array();
                    if(count($arr)>0){
                        foreach($arr as $arrs){
                          
                            global $acc;
                            if($arrs["Name"]==$acc){
                                $n=$arrs["Name"];
                                $b=$arrs["Balance"];
                                echo "<h5>Name Is ".$n."</h5>";
                                echo "<h5>Current Balance Is ".$b."</h5>";
                                $nacc=new Account($n,$b);
                                $newamt=$nacc->credit($amt);
                                $arrs["Balance"] =$newamt;
                            }
                            array_push($a,$arrs);
                        }
                      
                    }
                     
                    fileClear();
                    
                    foreach($a as $val){
                      
                        $res=json_encode($val);
                      
                        echo "<br>";
                        $myfile = fopen("accountfile.txt", "a") or die("Unable to open file!");
                        fwrite($myfile, $res."\n");
                        fclose($myfile);
                    }
                    
                }

                //for debit
                if(isset($_POST['debit'])){
                    $acc=$_POST['account'];
                    $amt=$_POST['amt'];
                    fileRead();
                    $a=array();
                    if(count($arr)>0){
                        foreach($arr as $arrs){
                        
                            global $acc;
                            if($arrs["Name"]==$acc){
                                $n=$arrs["Name"];
                                $b=$arrs["Balance"];
                                echo "<h5>Current Balance Is ".$b."</h5>";
                                $nacc=new Account($n,$b);
                                $newamt=$nacc->debit($amt);
                                $arrs["Balance"] =$newamt;
                            }
                            array_push($a,$arrs);
                        }
                        
                    }
                    
                    fileClear();
                    foreach($a as $val){
                        
                        $res=json_encode($val);
                      
                        echo "<br>";
                        $myfile = fopen("accountfile.txt", "a") or die("Unable to open file!");
                        fwrite($myfile, $res."\n");
                        fclose($myfile);
                    }
                }
            ?>
              </div>
                </div>
                </div>
              </div>
        </body>
</html>