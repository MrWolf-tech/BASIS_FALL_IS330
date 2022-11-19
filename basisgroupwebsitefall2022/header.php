
<?php
require_once('./backend_accounts.php');
session_start();

?>

<html> <!--END TAG IN footer.php-->
<head>
    <title>CIS330_Group_Project</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="universal.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--The scripts dont mean much here. But are here as a just in case.(For Jqueary and javascript)-->
</head>

<body> <!-- END TAG IN footer.php-->
    <div class="main">
    <header>
        <!-- Banner -->
        <div class="banner">
            <img tag="logo" alt="Welcome to Kelcema Audio" src="menupics/newkelcema.jpg"/>
            <div id="callus" style="float:right;"><img src="menupics/callus.png" /></div>
        </div>
        
        <!-- Navigation Bar Horizontal Fullscreen -->
    <div class="Navbar">
        <nav>
            <ul id="nav-container">
                <li class="nav-item" title="Account User" style="float:left">   <p>
                                                                                <?php 
                                                                                if($_SESSION['account'] !== Null){
                                                                                    print($_SESSION['account']->getUsername());}?>
                                                                                </p>
                                                                             </li>
                <li class="nav-item" title="Account" style="float:right" href="loginpage.php"><a href="loginpage.php"><img src="menupics/myspace.jpg" alt="Account" title="Account" /></a></li>
                <li class="nav-item" title="About Us" style="float:right" href="PAGELINK">  <a><img src="menupics/aboutus.jpg" alt="About Us" title="About Us"/></a></li> <!--PAGELINK needs file link-->
                <li class="nav-item" title="Live Sound" style="float:right" href="PAGELINK">  <a><img src="menupics/services.jpg" alt="Live Sound" title="Live Sound"/></a>         </li>
                <li class="nav-item" title="Gear" style="float:right" href="PAGELINK">  <a><img src="menupics/calendar.jpg" alt="Gear" title="Gear"/></a>           </li>
                <li class="nav-item" title="Retail Sales" style="float:right" href="PAGELINK">  <a><img src="menupics/pen.jpg" alt="Retail Sales" title="Retail Sales"/></a>       </li>
                <li class="nav-item" title="Photo Gallery" style="float:right" href="PAGELINK">  <a><img src="menupics/photogallery.jpg" alt="Photo Gallery" title="Photo Gallery"/></a>      </li>
                <li class="nav-item" title="Touring Services" style="float:right" href="PAGELINK">  <a><img src="menupics/truck.jpg" alt="Touring Services" title="Touring Services"/></a>   </li>
                <li class="nav-item" title="Contact Us" style="float:right" href="PAGELINK">  <a><img src="menupics/contactus.jpg" alt="Contact Us" title="Contact Us"/></a>         </li>
                <li class="nav-item" title="Home" style="float:right" href="index.php"><a href="index.php"><img src="menupics/home.jpg" alt="HOME" title="Home"/></a></li>
            </ul>
        </nav>
    </div>
    </header>




