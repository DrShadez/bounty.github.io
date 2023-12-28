<!DOCTYPE html>
<?php

//accessing session info
session_start();
require 'config.php';
//if user isn't logged in, redirect to signin
if (!isset($_SESSION["valid"])) {
    header('Location:signin.php');
}

try {
    //accessing info from bushes table
    $dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $sth = $dbh->prepare('SELECT * FROM `requests`');
    $sth->execute();
    $bush = $sth->fetchAll();
} catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
<html>

<head>
    <link rel="stylesheet" href="p2.css">
</head>

<body>
    <!--navbar config-->
    <ul class="nav">
        <li><a href="home.php">Your Requests </a></li>
        <li><a class="current" href="main.php">Bounty Board</a></li>
        <li><a href="cart.php">Claimed</a></li>
        <li><a href="vtest.php">Request</a></li>
        <li><a href="update.php">Updates</a></li>

        <li class="logoish"><a href="home.php">Bounty</a></li>
    </ul>

    <div class="main">
        <h2>Requests</h2>
        <p> Choose from any of the following requests, and save your selection to continue!</p>



        <!--logout-->
        <a href=logout.php>logout</a>

        <?php
        //displaying all the bushes with their corresponding images and values 

        //very big form that essentially puts all the bushes in checkboxes
        echo "<form action='idassign.php' id='bushoption' method='post'>";
        echo "<div class='choices'>";
        for ($x = 0; $x < count($bush); $x++) {
            echo "
            <div class='optionl'>

                </br>
        <div id='content'>
                    
                    <h3>";
            echo $bush[$x]['task'];
            echo "</br>";
            echo $bush[$x]['pay'];
            echo "</h3>

                    <p>";
            echo $bush[$x]['taskdetail'];
            echo "</p>
                    <input type='checkbox' name='selected[]' value='{$bush[$x]['id']}'>
                    <label for='selected[]'> Select?</label><br>
                </div>
            </div>";
        }
        echo "</div>";

        ?>
        <input type='submit' value='save selection'>
        </form>
    </div>
</body>

</html>