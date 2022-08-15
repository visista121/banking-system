<?php
    session_start();

    $con=mysqli_connect("localhost","root","","bankproject");
    if(!$con){
        die("Connection failed");
    }
    $_SESSION['user']=$_POST['user'];
    $_SESSION['sender']=$_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/transact.css?v=<?php echo time(); ?>">
</head>
<body>
    
    <div class="h">
        <span class = "s">SENDER</span>
        <span class = "r">RECIEVER</span>
    </div>

    <div class="sender">
        <h3 class="sh">Sender details</h3>
        <img src="img/user.png" alt="error" >
        <div class="det">
        <?php
        if (isset($_SESSION['user']))
        {
            $user = $_SESSION['user'];
            $result = mysqli_query($con,"SELECT * FROM customer WHERE Name='$user'");
            while($row = mysqli_fetch_array($result))
            {
                echo "<p>Sender ID: ".$row['ID_NO']."</p><br>";
                echo "<p name='sender'>Name : ".$row['NAME']."</p><br>";
                echo "<p>Balance :".$row['BALANCE']." </p><br>";
                echo "<p>phone number :".$row['PHONE_NO']." </p><br>";
                echo "<p>Email-id : ".$row['EMAIL']."</p>";
            }         
        }
      ?>
        </div>

    </div>

    <div class="tra">
        <img src="img/lending.png" alt="error" style = "display: inline-block;
        position: relative;
        top: -18em;
        width: 12em;
        left: 36em;">
    </div>

    <div class="receiver">
        <h3 class="rh">Select receiver</h3>
        <img src="img/user.png" alt="error" >
        <br></br>
        <div class="form">
            <form action="result.php" method = "post">
                <span> Select :</span>
                <select name="reciever" id="dropdown" required style="
                    width: 10em;
                    height: 2.3em;">
                    <option>Recievers</option>
                    <?php
                    $db = mysqli_connect("localhost", "root", "", "bankproject");
                    $res = mysqli_query($db, "SELECT * FROM customer WHERE Name!='$user'");
                    while($row = mysqli_fetch_array($res)) {
                        echo("<option> "."  ".$row['NAME']."</option>");
                    }
                    ?>
                </select>

                <br></br><br></br><br></br><br></br>
                <span>Amount to be transferred :</span>
                <input name="amount" type="number" style="width: 29%;border-radius: 5px;" min="10" required>
                <br></br><br></br>
                <button id="transfer" name="transfer" class="btn btn-default">Transfer</button>
                
            </form>
        </div>
    </div>

    <div class = "drop" >
        <button  class='button1' onclick="document.location='main.html'">HOME</button>
        <button  class='button2' onclick="document.location='records.php'">VIEW TRANSACTIONS</button>
    </div>

</body>
</html>