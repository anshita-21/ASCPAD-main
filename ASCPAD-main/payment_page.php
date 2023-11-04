<?php
include 'partials/_dbconnect.php';
error_reporting(0);
session_start();
// echo $_SESSION['veh_no'];
$vehicle_no = $_SESSION['veh_no'] ; 
// $vehicle_no=$_GET['vehicle_no'];
echo $vehicle_no;
    // $sql="select vehicle_no,police_name,police_st,date from towed_vehicles_rto where vehicle_no='$vehicle_no'";
    // $result=mysqli_query($conn,$sql);
    // $num=mysqli_num_rows($result);
    // $row=mysqli_fetch_assoc($result);
    // echo var_dump($row);

// include 'partials/_dbconnect.php';
// error_reporting(0);
// $vehicle_no=$_GET['vehicle_no'];
// $sql="Select * from vehicle_data where vehicle_no='$vehicle_no'";
// $result=mysqli_query($conn,$sql);
// echo $vehicle_no;
// echo "<h2>" . $vehicle_no . "</h2>";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  // $sql1="INSERT INTO `towed_vehicles_rto` (`pymt_amt`,`pymt_date`) VALUES (600, current_timestamp())";
  // DELETE FROM `towed_vehicles` WHERE vehicle_no='GJ05AA1234';
  $sql2="DELETE FROM towed_vehicles WHERE vehicle_no='$vehicle_no'";
  $result2=mysqli_query($conn,$sql2);
//   echo '<script type="text/javascript">

//   window.onload = function () { alert("Payment Successful"); }

// </script>';
$sql1="UPDATE `towed_vehicles_rto` SET `pymt_amt`='600',`pymt_date`=current_timestamp() WHERE vehicle_no='$vehicle_no'";
$result1=mysqli_query($conn,$sql1);

if($result2==true && $result1==true)
{
  // mysqli_close($db); // Close connection
  header("location:people.php"); 
  exit;	
}
else if($result2==true && $result1==false){
  echo "Payment not successful";
}
else
{
  echo "Error deleting record"; 
}

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

    <div class="phoneimg">
        <img src="./pngs/smartphone.png" alt="">
    </div>

    <div class="lcontainer">
        <div class="form">


            <div class="fields">
                <h1 class="headName">Pay Invoice</h1>

                <div class="form-group">
                    <label for="PaymentAmount">Payment amount : </label>
                    <div class="amount-placeholder">
                        <span>Rs.</span>
                        <span> 600.00</span>
                    </div>

                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="./svgs/person.svg" alt="">
                    </div>
                    <input type="text" name="cname" id="cname" placeholder="Enter Card Holder name">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="./svgs/credit-card.svg" alt="">
                    </div>
                    <input type="text" name="anumber" id="anumber" placeholder="Enter Your Card Number">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="./svgs/calendar.svg" alt="">
                    </div>
                    <input type="text" name="edate" id="edate" placeholder="Enter the Card Expiry date">
                </div>

                <div class="inputs">
                    <div class="img">

                        <img src="./svgs/lock.svg" alt="">
                    </div>
                    <input type="password" name="cvv" id="cvv" placeholder="Enter CVV">
                </div>
                <button type="submit">Pay - Rs.600</button>

            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div id="Checkout" class="inline">
            <h1>Pay Invoice</h1>

            <form action="payment_page.php" method="post">
                <div class="form-group">
                    <label for="PaymentAmount">Payment amount</label>
                    <div class="amount-placeholder">
                        <span>Rs.</span>
                        <span>600.00</span>
                    </div>
                </div>

                <div class="formcont">

                    <label>Name on card</label>
                    <input type="text" maxlength="255" required></input>
                    <label>Card number</label>
                    <input type="text" pattern="[0-9]{16}" required></input>
                    <label>Expiry date</label>
                    <input type="text" placeholder="MM / YY" required></input>
                   
                    <label>CVV</label>
                    <input type="password" pattern="[0-9]{3}" required></input>
                  



                </div>

                <button type="submit">Pay 600 Rs.</button>
            </form>
        </div>
    </div> -->


    <!-- <div class="container">
        <form action="payment_page.php" method="post" id="payment-form">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" readonly>
    
            <div class="payment-methods">
              <label>
                <input type="radio" name="payment-method" value="debit-card">
                Debit Card
              </label>
              <label>
                <input type="radio" name="payment-method" value="credit-card">
                Credit Card
              </label>
              <label>
                <input type="radio" name="payment-method" value="upi">
                UPI
              </label>
            </div>
    
            <div class="card-details ">
              <label for="card-number">Card Number:</label>
              <input type="text" id="card-number" name="card-number" minlength="16" maxlength="16" pattern="[0-9]{16}" required>
              <label for="expiry-date">Expiry Date (MM/YY):</label>
              <input type="text" id="expiry-date" name="expiry-date" minlength="5" maxlength="5"  required>
              <label for="cvv">CVV:</label>
              <input type="text" id="cvv" name="cvv" maxlength="3" minlength="3" pattern="[0-9]{3}" required>
            </div>
    
            <div class="upi-details">
              <label for="upi-id">UPI ID:</label>
              <input type="text" id="upi-id" name="upi-id">
            </div>
    
            <input type="submit" value="Pay Now">
          </form>
        <script src="payment_script.js"></script>
    </div> -->


</body>

</html>