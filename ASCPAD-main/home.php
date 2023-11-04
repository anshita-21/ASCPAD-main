<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tow - Site</title>
    <link rel="stylesheet" href="homecss.css">

</head>

<body>
<div class="login__logo">
        <img src="./depngs/towlogo.png" alt="No Logo">
        <a href="login.php">Login</a>
    </div>
    <div class="hr">
        <hr style="border: 0.1px solid rgb(229, 228, 228);">
    </div>
    <div class="login__head">

        <div class="tow_content">
            <img src="./depngs/townew.png" alt="">

            <h2>
                Traffic Police Tow Vehicle
            </h2>
            <p>
                E-challan status & online challan payment information
            </p>
        </div>

        <div class="searchSection">
            <form action="search.php" method="get">
                <div class="search">
                    <img src="./depngs/search.png" alt="">
                    <input type="text" name="search-veh" class="vehiNum" placeholder="Enter Vehicle Number" required pattern="[A-Za-z]{2}[0-9]{2}[A-Za-z]{2}[0-9]{4}">
                </div>

                <div class="btn">

                    <a href="">
                        <button type="submit" class="srch_btn">Search</button>
                        <!-- <button>Search</button> -->
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="hr2">
        <hr style="border: 0.1px solid rgb(229, 228, 228);">
    </div>

    <div class="login__content1">
        <div class="content__1">
            <div class="content__def">
                <h1>What is traffic e-challan?</h1>
                <p>An e-challan is generated with the help of an electronic system and issued to defaulters who do not obey the traffic rules. If a driver is issued an e-challan, they are notified about it via a text message, or a copy of it is directly
                    sent to the address registered with their vehicle number. Traffic e challan status can also be checked online and paid through the ASCPAD app or government websites
                </p>
            </div>
            <div class="content__img">
                <img src="./depngs/trafficimage.png" alt="">
            </div>
        </div>
    </div>

    <div class="hr2">
        <hr style="border: 0.1px solid rgb(229, 228, 228);">
    </div>

    <div class="content__2">
        <div class="content__head">
            <h2>What are the reasons for which you can be issued a challan?</h2>
        </div>
        <div class="content__rules">
            <div class="rules image1">
                <img src="./depngs/signal3.png" alt="">
                <p>Violation of traffic rules</p>
            </div>
            <div class="rules image2">
                <img src="./depngs/license2.png" alt="">
                <p>Driving without a valid license

                </p>
            </div>
            <div class="rules image3">
                <img src="./depngs/car-signal2.png" alt="">
                <p>Jumping red lights</p>
            </div>
            <div class="rules image4">
                <img src="./depngs/speed2.png" alt="">
                <p>Over-speeding the specified speed limit</p>
            </div>
            <div class="rules image5">
                <img src="./depngs/alcohol2.png" alt="">
                <p>Driving under influence of alcohol</p>
            </div>

            <div class="imagesec">
                <div class="rules image6">
                    <img src="./depngs/info2.png" alt="">
                    <p>Refusal to share information when asked</p>
                </div>
                <div class="rules image7">
                    <img src="./depngs/uncar2.png" alt="">
                    <p>Driving an unauthorized vehicle</p>
                </div>
                <div class="rules image8">
                    <img src="./depngs/insurance2.png" alt="">
                    <p>Driving without a valid insurance policy</p>
                </div>
                <div class="rules image9">
                    <img src="./depngs/obstruction2.png" alt="">
                    <p>Causing traffic obstruction, etc.</p>
                </div>
            </div>
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

    <div class="loading">
        <div class="loading-icon"></div>
    </div>
</body>
<script>
    function fadeOut(event) {
        event.preventDefault(); // Prevent the default link behavior
        document.querySelector('body').classList.add('fadeOut');
        document.querySelector('.loading').classList.add('active');
        setTimeout(function() {
            window.location.href = event.target.href;
        }, 500); // Wait 1 second before navigating to the new page
    }

    function fadeIn() {
        document.querySelector('body').classList.add('fadeIn');
        document.querySelector('.loading').classList.remove('active');
    }
</script>
</html>


<!-- change password -->
<!-- forget password -->
<!-- scanner -->
<!-- sms service -->
<!-- location of police station -->
<!-- email service for challan payment -->
<!-- print challan bill -->




<!-- tow police vehicle ddetails -->
<!-- challan police hamburger -->/
<!-- challan police dropdown -->
<!-- challan police vehicle input selection -->
<!-- search page pay now button -->