<?php
include 'partials/_dbconnect.php';
error_reporting(0);
session_start();
$vehicle_no = $_SESSION['veh_no'] ; 
// echo $vehicle_no;
$amt=$_GET['total'];
if($_SERVER["REQUEST_METHOD"]=="POST"){

  $sql2="DELETE FROM challan_vehicle WHERE vehicle_no='$vehicle_no'";
  $result2=mysqli_query($conn,$sql2);

$sql1="UPDATE `challan_vehicle_rto` SET `pymt_status`='paid',`pmt_date`=current_timestamp() WHERE vehicle_no='$vehicle_no'";
$result1=mysqli_query($conn,$sql1);

echo '<script type="text/javascript">'; 
echo 'alert("Payment Success !!");'; 
echo 'window.location.href = "people.php";';
echo '</script>';

// if($result2==true && $result1==true)
// {
//   header("location:people.php"); 
//   exit;	
// }
// else if($result2==true && $result1==false){
//   echo "Payment not successful";
// }
// else
// {
//   echo "Error deleting record"; 
// }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>
    <link rel="stylesheet" href="payment-style.css">
</head>
<body>
<form action="payment_page_rule.php" method="post">
<div class="phoneimg">
        <img src="img/smartphone.png" alt="">
    </div>

    <div class="lcontainer">
        <div class="form">


            <div class="fields">
                <h1 class="headName">Pay Invoice</h1>

                <div class="form-group">
                    <label for="PaymentAmount">Payment amount : </label>
                    <div class="amount-placeholder">
                        <span>Rs.</span>
                        <span> <?php echo $amt ?></span>
                    </div>

                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="img/person.svg" alt="">
                    </div>
                    <input type="text" name="cname" id="cname" maxlength="255" required placeholder="Enter Card Holder name">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="img/credit-card.svg" alt="">
                    </div>
                    <input type="text" name="anumber" id="anumber" maxlength="16" pattern="[0-9]{16}" required placeholder="Enter Your Card Number">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="img/calendar.svg" alt="">
                    </div>
                    <input type="text" name="edate" id="edate" maxlength="5" required placeholder="Enter the Card Expiry date">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="img/lock.svg" alt="">
                    </div>
                    <input type="password" name="cvv" id="cvv" maxlength="3" pattern="[0-9]{3}" required placeholder="Enter CVV">
                </div>
                <button type="submit">Pay Now</button>

            </div>
        </div>
    </div>
    </form>
</body>
</html>