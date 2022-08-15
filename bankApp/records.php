<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/records_style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<div class='heading'>
        <img class = 'image' src="img/transaction.png" alt="error">
        <h2 class = 'title'>TRANSACTION RECORDS</h2>
    </div>
    <table class = 'table' style = 'width:65%' style = "border: 1px solid black;
        border-collapse: collapse;
        margin: 0 30vw;
        font-family: 'Raleway', sans-serif;
        position: relative;
        bottom: 11vh;">
    <tr>
    <th>TRANSACTION NUMBER</th>
    <th>SENDER</th>
    <th>RECIEVER</th>
    <th>AMOUNT</th>
    <th>TIME</th>
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
    
    $sql = "SELECT * FROM transfer ORDER BY T_ID DESC ";
    $result = $connection->query($sql);
    if($result-> num_rows > 0){
        while($row = $result-> fetch_assoc()){
            echo "<tr>";
            echo "<form method ='post' action = 'select_transaction.php'>";
            echo "<td>". $row['T_ID'] . "</td>
            <td>". $row['sender'] . "</td>
            <td>". $row['reciever'] . "</td>
            <td>". $row['amount'] . "</td>
            <td>". $row['time'] . "</td>";
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
        <button  class='button2' onclick="document.location='index.php'">VIEW CUSTOMERS</button>
    </div>
    
<?php
    $connection-> close();
?>

</body>
</html>