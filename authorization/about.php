<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Website</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="wrapper">
        <?php
        include __DIR__ . "/block/header.php";
        ?>
        <div class="hero-about container">
            <div class="info">
                <h1>Lorem Ipsum is simply dummy text of the printing and.</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s.</p>
                <button class="btn">Get in touch</button>
            </div>
            <img src="/img/about-banner.png" alt="">
        </div>

        <div class="container work">
            <h2>Why work with us</h2>
            <div class="blocks">
                <div class="block">
                    <span class="badge purple">Lorem ipsum</span>
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s,</p>
                </div>
                <div class="block">
                    <span class="badge brown">Lorem ipsum</span>
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s,</p>
                </div>
                <div class="block">
                    <span class="badge green">Lorem ipsum</span>
                    <h3>Lorem Ipsum</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s,</p>
                </div>
            </div>
        </div>
    </div>

     <?php 
include __DIR__ . "/block/footer.php";
?>
</body>

</html>