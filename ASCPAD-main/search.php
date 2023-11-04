<?php 
include 'partials/_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="GET"){
    
    $noresult=true;
    $vehicle=strtoupper($_GET["search-veh"]);
    $sql="select * from towed_vehicles where vehicle_no='$vehicle'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);
    if($num==1){
        $vehicleno=$row['vehicle_no'];
        $p_name=$row['police_name'];
        $police_st=$row['police_st'];
        $p_phone=$row['police_phone'];
        $date=$row['date'];
        $noresult=false;
    }
    else{
        $noresult=true; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search|Tow - Site</title>
    <link rel="stylesheet" href="searchcss.css">
    <style>
        body {
            position: relative;
        }
        
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: none;
        }
        
        .loading.active {
            display: block;
        }
        
        .loading-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 5px solid #fff;
            border-top-color: #007bff;
            animation: loading 1s ease-in-out infinite;
        }
        
        @keyframes loading {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
<div class="login__logo">
        <img src="./depngs/towlogo.png" alt="No Logo">
        <a href="login.php">
            <button>Login</button>
        </a>
    </div>

    <div class="container">
        <h2>Your Vehicle Details</h2>
        <div class="details">
            <?php
                if($noresult){
                    echo '
                    <div class ="result">
                    <h3> No record found </h3>
                    </div>';
                }
                else{
                    echo '<div class="result">
                    <p>Vehicle Number: '.$vehicleno.'</p>
                    <p>Police Name: '.$p_name.'</p>
                    <p>Police Station: '.$police_st.'</p>
                    <p>Police phone no: '.$p_phone.'</p>
                    <p>Date/Time: '.$date.'</p>
                    
                    <a href="login.php">
                        <button>Pay</button>
                    </a>
                    </div>';
                }
                ?>
            <!-- <p>Vehicle number :</p>
            <p>Police Name :</p>
            <p>Police Station :</p>
            <p>Police Phone no : </p>
            <p>Date / Time: </p> -->
            <!-- <a href="paymentlogin.html" onclick="fadeOut(event)">Pay</a> -->
            <!-- <a href="paymentlogin.html">
                <button>Pay</button>
            </a> -->
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
<script>
    function fadeOut(event) {
        event.preventDefault(); // Prevent the default link behavior
        document.querySelector('body').classList.add('fadeOut');
        document.querySelector('.loading').classList.add('active');
        setTimeout(function() {
            window.location.href = event.target.href;
        }, 1000); // Wait 1 second before navigating to the new page
    }

    function fadeIn() {
        document.querySelector('body').classList.add('fadeIn');
        document.querySelector('.loading').classList.remove('active');
    }
</script>

</html>