<?php

//Session starten
session_start();

//Die Klasse verfügbar machen
include_once("../backendPhp/cart.php");

//Eine Neue Instanz der Klasse cart erstellen
$cart = new Cart();

//Falls Produkte in der Session bereits im Warenkorb - dann zeige diese an
$productCount = $cart->get_cart_count();


$welcomeString = "";
//create welcome string if logged in 
if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] == 111) {
        //we are logged in
        $welcomeString .= "Hallo, ";
        $welcomeString .=  $_SESSION["firstname"];
        $welcomeString .= " ";
        $welcomeString .=  $_SESSION["lastname"];
    }
}

?>

<!DOCTYPE html>
<html lang="de">

<head>

    <title>Webshop - Kontaktformular</title>
    <meta charset="utf-8">

    <!-- our Styles -->
    <link rel="stylesheet" href="../css/headerAndFooterArea.css">
    <link rel="stylesheet" href="../css/productsGrid.css">
    <link rel="stylesheet" href="../css/formContact.css" <!-- Webseite responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet & FontAwesome für Icons -->
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../libraries/FontAwesome/CSS/all.css">

    <!-- Für das Karussell-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function () { // wichtig!

            setInterval(function () {
                $.get("../backendPhp/getNumActiveUsers.php", {},
                    function (numActiveUsers) {
                        var activeUserElement = document.getElementById("numUserOnline");
                        activeUserElement.innerText = numActiveUsers;
                        console.log("updated active users");
                    });
            }, 1000);

        });
    </script>

</head>

<body>

    <!-- Kopfbereich -->
    <header class="titleBand w3-padding-8">

        <div class="w3-bar w3-center">
            <h1 class="myTitle">shop<strong class="myTitle">33</strong></h1>
            <p class="myTitle">Only the greatest discounts!</p>
        </div>

        <div class="centerMargin"><a href="home.php">Home</a></div>

        <div class="centerMargin"><a href="aboutUs.php"> Über uns</a></div>

        <div></div>

        <div class="centerMargin">
            <div>
                <h3 class="myTitle"><?php echo $welcomeString ?></h3>
            </div>
        </div>

        <div></div>

        <div class="centerMargin">
            <!-- shopping cart -->
            <a href="shoppingCart.php"><i class="fa fa-shopping-cart fa-2x"></i>(<?php echo $productCount ?>)</a>
        </div>

        <div class="centerMargin">
            <?php
            //show My Orders Button if logged in
            $MyOrdersHtml = '<a href="myOrders.php" class="centerMargin"><i class="fas fa-box-open"></i> Meine Bestellungen</a>';
            if (isset($_SESSION["login"])) {
                if ($_SESSION["login"] == 111) {
                    echo $MyOrdersHtml;
                }
            }

            ?>
        </div>

        <div class="centerMargin">
            <?php
            // Login, wenn User noch nicht angemeldet ist und Logout, wenn er angemeldet ist
            $loginHTML = '<a href="login.php" class="centerMargin"><i class="fas fa-user"></i> Login</a>';
            $logoutHTML = '<a href="logout.php" class="centerMargin"><i class="fas fa-user"></i> Logout</a>';
            if (isset($_SESSION["login"])) {
                if ($_SESSION["login"] == 111) {
                    echo $logoutHTML;
                } else {
                    echo $loginHTML;
                }
            } else {
                echo $loginHTML;
            }
            ?>
        </div>

    </header>

    <div class="w3-container w3-center">
        <div class="w3-panel w3-border-top w3-border-bottom">
            <h3>Kontaktformular <i class="fas fa-envelope"></i></h3>
        </div>
    </div>

    <div class="formContact">
        <form method="post" action="../backendPhp/processContactForm.php" class="form-horizontal">
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="firstname">Name</label>
                    <div class="col-md-6">
                        <input id="firstname" name="firstname" type="text" placeholder="Vorname"
                            class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="lastname"></label>
                    <div class="col-md-6">
                        <input id="lastname" name="lastname" type="text" placeholder="Nachname"
                            class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email</label>
                    <div class="col-md-6">
                        <input id="email" name="email" type="text" placeholder="E-Mail-Adresse"
                            class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="betreff">Betreff</label>
                    <div class="col-md-6">
                        <select id="betreff" name="betreff" class="form-control" required>
                            <option value="" disabled selected>Wähle bitte eine der folgenden Optionen aus</option>
                            <option value="1">Supportanfrage</option>
                            <option value="2">Probleme bei der Bestellung</option>
                            <option value="3">Probleme bei der Lieferung</option>
                            <option value="4">Sonstiges</option>
                        </select>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="message">Nachricht</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="message" name="message"
                            placeholder="Beschreiben Sie hier bitte Ihr Anliegen."
                            style="width:485px; height:100px;"></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="sendContactForm"></label>
                    <div class="col-md-4">
                        <button type="submit" id="sendContactForm" name="sendContactForm" class="btn btn-success"
                            style="width:485px; height:50px;">Abschicken</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

    <!-- Fußleiste -->
    <footer class="footer w3-padding-32">

        <div class="centerMargin"><a href="impressum.php">Impressum</a></div>
        <div class="centerMargin"><a href="contactForm.php"><i class="fas fa-envelope"></i> Kontakt</a></div>

        <div></div>
        <div></div>
        <div></div>

        <div class="centerMargin">
            <?php
                        if (isset($_SESSION["login"])) {
                            if ($_SESSION["login"] == 111) {
                                $dateString = date("d.m.Y", $_SESSION['lastLoginTime']);
                                echo '<span>Sie waren zuletzt am <ins>' . $dateString . '</ins> online</span>';
                            }
                        }
                    ?>
        </div>

        <div></div>

        <div class="centerMargin">
            <span><ins id="numUserOnline"></ins> User online</span>
        </div>

    </footer>

</body>

</html>