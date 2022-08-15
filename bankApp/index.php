<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer details</title>
    <link rel="stylesheet" href="css/details_style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
</head>
<body>

    <div class='heading'>
        <img class='image' src="img/customer.png" alt="could not load">
        <h2 class = 'title'>CUSTOMER DETAILS</h2>
    </div>
    <table class = 'table' style = 'width:65%' style = "border: 1px solid black;
        border-collapse: collapse;
        margin: 0 30vw;
        font-family: 'Raleway', sans-serif;
        position: relative;
        bottom: 11vh; ">
    <tr>
    <th>ID_NO</th>
    <th>NAME</th>
    <th>BALANCE</th>
    <th>TRANSACT</th>
    </tr>
    <?php

    $connection = mysqli_connect('localhost', 'root', "", "bankproject");
    if($connection){
        // echo "Connection established";
    }
    else{
        echo "ERROR connecting!";
        die("connection failed");
    }
    
    $sql = "SELECT ID_NO, NAME, BALANCE FROM customer";
    $result = $connection->query($sql);
    if($result-> num_rows > 0){
        while($row = $result-> fetch_assoc()){
            echo "<tr>";
            echo "<form method ='post' action = 'select_transaction.php'>";
            echo "<td>". $row['ID_NO'] . "</td>
            <td>". $row['NAME'] . "</td>
            <td>". $row['BALANCE'] . "</td>";
            echo "<td><button  class='button' name='user'  id='myBtn' value= '{$row['NAME']}' ><span>send money</span></button></td>";
            echo "</form>";
            echo  "</tr>";
        }

    }   
    else {
        echo "0 result";
    }
    ?>
    
    <div class = "drop" >
        <button  class='button1' onclick="document.location='main.html'">HOME</button>
        <button  class='button2' onclick="document.location='records.php'">VIEW TRANSACTIONS</button>
    </div>

    <div id="myModal" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>

    </div>
    
    <?php
        $connection-> close();
    ?>
    </table>    
</body>
</html>



