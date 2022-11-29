<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="profilepage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>



<div class="main"> 

<div class="about"> 
    <?php require_once('./select_customer_form.php') ?>
</div>






<div class="contactme">
    <h3>Contact Us (WIP)</h3>
    <div class="contact-container">
        <input required id="fname" type="text" name="fname" placeholder="First Name"><br>
        <input id="lname" type="text" name="lname" placeholder="Last Name"><br>
        <input id="phone" type="number" maxlength="10" minlength="10" name="phone" placeholder="Phone Number"><br>
        <input id="email" type="email" name="email" placeholder="Email"><br>
    </div>
</div>
</div>
</body>
</html>

