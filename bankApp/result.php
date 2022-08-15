<?php
    session_start();
    $server="localhost";
    $username="root";
    $password="";
    $con=mysqli_connect($server,$username,$password,"bankproject");
    if(!$con){
        die("Connection failed");
    }

    $flag=false;

    if (isset($_POST['transfer']))
    {
        $sender=$_SESSION['sender'];
        $receiver=$_POST["reciever"];
        $amount=$_POST["amount"];
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/result_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
</head>
<body>

    <?php
        if($receiver == 'Recievers'){
            // echo "Transaction failed!!";
        }
        else {
            $sql = "SELECT BALANCE FROM customer WHERE NAME='$sender'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($amount > $row["BALANCE"] or $row["BALANCE"] - $amount < 100){
                        $messege = "'Error','Insufficient Balance!','error'";
                    }
                    else {
                        $sql = "UPDATE `customer` SET BALANCE=(BALANCE-$amount) WHERE NAME='$sender'";
        
                        if ($con->query($sql) === TRUE) {
                            $flag=true;
                        } 
                        else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
    
                }

                
            }
            else {
                $messege = "0 results";
            }
            $sql = "INSERT INTO `transfer` ( `sender`, `reciever`, `amount`) VALUES ( '$sender','$receiver','$amount')";
            if ($con->query($sql) === TRUE) {
                $flag = true;
            } else 
            {
              echo "Error updating record: " . $con->error;
              $flag = false;
            
            }
        }

        if($flag == true){
            $sql = "UPDATE `customer` SET BALANCE=(BALANCE+$amount) WHERE NAME='$receiver'";
            if($con->query($sql) === TRUE){
                $flag = true;
            }
            else {
                $messege = "Error updating record: " . $con->error;
                $flag = false;
            }
        }
        
    ?> 

    <div class="box">
        <?php
            if($flag==true){
                
                ?>
                <img class = "correct" src="img/check.png" alt="error loading">
                <p class="c">
                    Transaction sucessful!!
                </p>
                <?php
                // $messege = "Transaction successfullll!!!!";
            }
            elseif($flag==false)
            {
            ?>
                <img class = "wrong" src="img/delete.png" alt="error">
                <p class="w">
                    Transaction failed!!
                </p>
                <?php
                    // $messege = "transaction failed!";
                    
            }
                    ?>

        
        <button class="home" onclick="document.location='main.html'">HOME</button>
        <button class="tran" onclick="document.location='records.php'">VIEW TRANSACTIONS</button>
        <button class="cust" onclick="document.location='index.php'">VIEW CUSTOMERS</button>
    </div>
</body>
</html>



