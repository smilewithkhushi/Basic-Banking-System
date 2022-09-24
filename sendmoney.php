<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BANKING SYSTEM</title>
<link rel="stylesheet" href="style_sendmoney.css">
  </head>

  <body>
<div class="navbar">
<center>
    <hr color="grey" width=70% size=1>
  <h1> BASIC BANKING SYSTEM </h1>
  <a href="index.php">Home</a>
  <a class="active" href="sendmoney.php">Send Money</a>
  <a href="customers.php">View All Customers</a>
  <a href="transactions.php">Transactions</a>
  <a href="contact.php">Contact Us</a>
  <a href="about.php">About Us</a>
  <hr color="grey" width=70% size=1>
  </center>
</div>

<div class="container">
<div class="header"> Welcome to Sparks Bank! </div>
<img src="bank.png" height=45% width=25% alt="Welcome to the sparks bank!" style="padding: 5px; margin-right: 8vw; margin-top:8vh; float:right"> 
<br><br>
<br><br>
</div>
<br><br>
<center>
<div class="contentbox">
  <h1> TRANSFER MONEY </h1>

  <div class="subcontent">
   
<form action="sendmoney.php" method="POST">    
    <h3> Sender Account </h3>
    
<?php
$server="localhost";
$username="root";
$password="";
$dbname="bankingsystem";

//create connections
$con=mysqli_connect( $server, $username, $password, $dbname);
//check for connection success
if (!$con){
 die("Connection to this database failed due to ".mysqli_connect_error());
}

echo "<select id='sender' name='sender'>";
echo "<option value='' disabled selected hidden>Choose the sender</option>";
$sql1="Select Name, Account_no from customers";
$result= $con-> query($sql1);
if ($result-> num_rows>0){
  while ($row = $result-> fetch_assoc()){
    echo "<option value=".$row["Account_no"].">".$row["Name"]."<p> &nbsp; &nbsp;</p>". $row["Account_no"]."</option>";
  }
}
echo "</select>";
echo "<br> <br> <h3> Receiver Account </h3>";

echo "<select id='receiver' name='receiver'>";
echo "<option value='' disabled selected hidden>Choose the receiver</option>";
$result= $con-> query($sql1);
if ($result-> num_rows>0){
  while ($row = $result-> fetch_assoc()){
    echo "<option value=".$row["Account_no"].">".$row["Name"]."<p> &nbsp; &nbsp;</p>". $row["Account_no"]."</option>";
  }
}
echo "</select>";
$con->close();
?>
<br><br>
<h3> Amount </h3><input class='input' type="text" name="amount" id="amount" placeholder="Enter the amount"><br>
<br>
    <button class="button" value="submit"> Send Money</button>
<br> <br>
</form>
 


<?php

if (isset($_POST['sender'])){

$server="localhost";
$username="root";
$password="";
$dbname="bankingsystem";
$tablename="customers";

$con=mysqli_connect( $server, $username, $password, $dbname);
if (!$con){
    die("Connection to this database failed due to ".mysqli_connect_error());
}

$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$amount=$_POST['amount'];


$sql1 = "SELECT Name, Balance FROM customers WHERE Account_no=$sender"; 
$sql2 = "SELECT Name, Balance FROM customers WHERE Account_no=$receiver"; 
//query to select the amounts from the database for R and S
$res1= $con-> query($sql1);
$res2= $con-> query($sql2);
$sender_bal=$receiver_bal=$sender_name=$receiver_name=0;

while($row = $res1-> fetch_assoc()){
  $sender_bal=$row['Balance'];
  $sender_name=$row['Name'];
}

while($row=$res2-> fetch_assoc()){
  $receiver_bal=$row['Balance'];
  $receiver_name=$row['Name'];
}

if($sender_bal>=$amount){
  //calculate final balance
  $receiver_bal=$receiver_bal+$amount;
  $sender_bal=$sender_bal-$amount;
  
  $update1="UPDATE customers SET Balance=$receiver_bal WHERE Account_no=$receiver";
  $update2="UPDATE customers SET Balance=$sender_bal WHERE Account_no=$sender";
  
  $updatebal_rec=$con-> query($update1);
  $updatebal_sender=$con-> query($update2);

  if ($updatebal_sender==true && $updatebal_rec==true){
      echo "<h3 style='color: green'> Transaction Successful! </h3>";
      $status="Transaction Successful";

      //add into records when transaction is successful
      $query_rec="INSERT INTO transactions(Sender_AccountNo, Sender_Name, Receiver_AccountNo, Receiver_Name, Amount_transferred, Sender_Balance, Receiver_Balance, Status) VALUES('$sender', '$sender_name', '$receiver', '$receiver_name','$amount', '$sender_bal', '$receiver_bal', '$status')";
      if ($con->query($query_rec)==true){
        //echo "Successfully Inserted";
        $insert=true;
    }
    else{
        echo "ERROR : $sql <br> $con->error";
    }
  }
  else{
    echo "<h3 style='color: brown'> ERROR! Invalid Account Number  </h3>";
    echo "ERROR : $sql <br> $con->error";
}
}
if ($amount>$sender_bal){
  //also add the transaction of failed transactions
  $status="Transaction Failed";

  $query_rec="INSERT INTO transactions(Sender_AccountNo,Sender_Name, Receiver_AccountNo, Receiver_Name, Amount_transferred, Sender_Balance, Receiver_Balance, Status) VALUES('$sender', '$sender_name', '$receiver','$receiver_name', '0', '$sender_bal', '$receiver_bal', '$status')";
  if ($con->query($query_rec)==true){
      $insert=true;
  }
  else{
        echo "ERROR : $sql <br> $con->error";
  }
  echo "<h3 style='color: red'> Transaction Failed! Insufficient Balance in Sender's Account </h3>";
}
$con->close();
}
?>
 
</div>
</div>

<div class="pagebreak">
</div>

<div style="width: 80%; color: white; padding: 20px">
<h5>When a customer deposits money into the bank, this money is on loan to the bank and the bank’s most important obligation is to follow the customer’s instructions in relation to this money. The customer can withdraw money from the account at any point, and they can also stop payment of a cheque by informing the bank. If an overdraft agreement is in place, the bank must also give reasonable written notice of any decision to reduce overdraft credit.
</h5>
</div>
<div class="pagebreak">
</div>
<div class="footer"> <center>
  Made with ❤️ By Khushi !
</center>
</div>
</center>
  </body>
</html>
