<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Website</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php 
include __DIR__ . "/block/header.php";
?>
    <div class="container hero-contacts">
        <h1>Lorem Ipsum is simply dummy text of the printing and.</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        <img src="img/Map.png" alt="">
    </div>

    <div class="feedback">
        <div class="container">
            <h2>Say hello</h2>
            <p>Lorem Ipsum is simply dummy text of the printing .</p>

            <form>
                <div class="inline">
                    <div>
                        <label>First Name</label>
                        <input type="text">
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text">
                    </div>
                </div>
                <label>Email Address</label>
                <input type="email" class="one-line">

                <label>Message</label>
                <textarea class="one-line"></textarea>

                <button type="button">Get in touch</button>
            </form>
        </div>
    </div>

    
<?php 
include __DIR__ . "/block/footer.php";
?>
</body>

</html>