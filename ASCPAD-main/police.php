<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
include 'partials/_dbconnect.php';
$userid=$_SESSION['username'];
$sql="Select * from tow_police where userid='$userid'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$police_name=$row['name'];
$police_id=$row['userid'];
$police_phone=$row['phone'];
$police_st=$row['police_st'];

if($_SERVER["REQUEST_METHOD"]=="POST"){

$vehicle_no=strtoupper($_POST["vehicle_no"]);

$existSql="Select * from towed_vehicles where vehicle_no='$vehicle_no'";
$result4=mysqli_query($conn,$existSql);
$numExistRows=mysqli_num_rows($result4);
$showAlert=false;

if($numExistRows>0){
    $showAlert=true;
echo '<script type="text/javascript">

        window.onload = function () { alert("Alert! Data already exists."); }

</script>';
}
else{
  $exists=false;

    $sql1="INSERT INTO `towed_vehicles` (`vehicle_no`, `police_name`, `police_st`, `police_phone`,`date`) VALUES ('$vehicle_no', '$police_name', '$police_st', '$police_phone',current_timestamp())";
    $sql2="INSERT INTO `towed_vehicles_rto` (`vehicle_no`, `police_name`, `police_st`, `police_phone`,`date`) VALUES ('$vehicle_no', '$police_name', '$police_st', '$police_phone',current_timestamp())";
    $result1=mysqli_query($conn,$sql1);
    $result2=mysqli_query($conn,$sql2);
    
    echo '<script type="text/javascript">

        window.onload = function () { alert("Success! Submitted."); }

</script>';
    if($vehicle_no=='GJ05AB0123'){
    exec('python sms.py');
    }

 }
}
// $dt=curdate();
$count_sql="SELECT count(*) FROM `towed_vehicles_rto` WHERE police_name='$police_name' AND DATE(date)=CURDATE()";
$result=mysqli_query($conn,$count_sql);
$row=mysqli_fetch_assoc($result);
// echo var_dump($row);
// echo var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police|Tow - Site</title>
    <link rel="stylesheet" href="policecss.css">
</head>

<body>
<nav>
        <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>

                <div class="menu-items">
                    <li><a href="#">Police id : <?php echo $police_id?></a></li>
                    <li><a href="#">Police Name : <?php echo $police_name?></a></li>
                    <li><a href="#">Police Station : <?php echo $police_st?></a></li>
                    <li><a href="#">Phone No. : <?php echo $police_phone?></a></li>
                    <li><a href="#">No. of vehicles towed today: <?php echo $row['count(*)']?></a></li>
                    <li class="plink"><a href="veh_det.php?police_name=<?php echo $police_name?>">Click here to get towed vehicle details by you: </a></li>
                </div>
            </div>
            <div class="login__logo">
                <img src="./depngs/towlogo.png" alt="No Logo">
            </div>
            <div class="logout">
                <a href="logout.php">
                    <!-- <button>Pay</button> -->
                    <img src="./depngs/logout.png" alt="">
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="photo">
            <img src="./depngs/nnumberplate.png" alt="">
        </div>
        <div class="searchSection">
            <form action="police.php" method="post">
                <div class="search">
                    <input type="text" required pattern="[A-Za-z]{2}[0-9]{2}[A-Za-z]{2}[0-9]{4}" name="vehicle_no" class="vehiNum" placeholder="Enter Vehicle Number" minlength="10" maxlength="10">
                </div>

                <div class="btn">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <div class="footer">
        <div class="footer-links">
            <div class="footer-links_logo">
                <img src="./depngs/towlogo.png" alt="">
                <p>Lorem ipsum dolor sit amet. <br /> All Rights Reserved</p>
            </div>
            <div class="footer-links_div">
                <h4>Links</h4>
                <p>Overons</p>
                <p>Social Media</p>
                <p>Counters</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Company</h4>
                <p>Terms & Conditions</p>
                <p>Privacy Policy</p>
                <p>Contact</p>
            </div>
            <div class="footer-links_div">
                <h4>Get in touch</h4>
                <p>Crechterwoord K12 182 DK Alknjkcb</p>
                <p>085-132567</p>
                <p>info@payme.net</p>
            </div>
        </div>

    </div>
    <div class="footer-copyright">
        <p>© 2023 ASCPAD. All rights reserved.</p>
    </div>

</body>

</html>
