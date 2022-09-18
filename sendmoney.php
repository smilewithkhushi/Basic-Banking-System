<?php

$insert=0;

$server="localhost";
$username="root";
$password="unbroken2003";
$dbname="bankingsystem";
$tablename="customers";

$con=mysqli_connect( $server, $username, $password, $dbname);
if (!$con){
    die("Connection to this database failed due to ".mysqli_connect_error());
}

$sender=$_POST['sender'];
$receiver=$_POST['receiver'];
$amount=$_POST['amount'];

$senderbal="Select Balance from customers WHERE Account_no EQUALS $sender";
$receiverbal="Select Balance from customers WHERE Account_no EQUALS $receiver";

$newbal=$receiverbal+$amount;
if ($senderbal>=$amount){
  $updatebal="INSERT INTO customers(Balance) WHERE Account_no EQUALS receiver";
}

$result= $con-> query($sql);

$sql = "INSERT INTO trip(Name, Age, Gender,Email, Phone, Other) 
        VALUES ('$name', '$age', '$gender', '$email', '$phone', '$other' );";

//mysqli functions are used to procedural language programming and adding into database

//execute the query
if ($con->query($sql)==true){
    //echo "Successfully Inserted";
    $insert=1;
}else-if(){

}
else{
  $insert=0;
    echo "ERROR : $sql <br> $con->error";
}
//close the database connection
$con->close();

?>
 
 
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
<img src="bank.png" height=45% width=20% alt="Welcome to the sparks bank!" style="padding: 5px; margin-right: 8vw; margin-top:8vh; float:right"> 
</div>
<br>
<center>
<div class="contentbox">
  <h1> TRANSFER MONEY </h1>

  <div class="subcontent">
   
<form action="index.php" method="post">    
    <h3> Sender Account </h3><input class='input' type="text" name="sender" id="sender" placeholder="Enter the sender's account number "> <br>
    <h3> Receiver Account </h3><input class='input' type="text" name="receiver" id="receiver" placeholder="Enter the receiver's account number "><br>
    <h3> Amount </h3><input class='input' type="text" name="amount" id="amount" placeholder="Enter the amount"><br>
    <br>
    <button class="button"> Send Money</button>

</form>

<?php 
if ($insert==1){
echo "<h4 style='color: green'> Transaction Successful! </h4>";
}else if ($insert==-1){
  echo "<h4 style='color: red'> Transaction Failed! Insufficient Balance in Sender's Account </h4>";
}else{
  echo "<h4 style='color: brown'> ERROR! Invalid Account Number  </h4>";
}
?>
  </div>
</div>

<div class="pagebreak">
</div>

<div style="width: 80%; color: white; padding: 20px">
<h4>When a customer deposits money into the bank, this money is on loan to the bank and the bank’s most important obligation is to follow the customer’s instructions in relation to this money. The customer can withdraw money from the account at any point, and they can also stop payment of a cheque by informing the bank. If an overdraft agreement is in place, the bank must also give reasonable written notice of any decision to reduce overdraft credit.
</h4>
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
