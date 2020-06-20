<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Webshop - Login</title>
    <meta charset="utf-8">

    <!-- our Styles -->
    <link rel="stylesheet" href="../css/headerArea.css">

    <!-- for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />


    <!-- Webseite responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheet & FontAwesome für Icons -->
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../libraries/FontAwesome/CSS/all.css">

    <!-- Benötigt für login -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- JS for SHA256 -->
    <script src="../libraries/StanfordJavascriptCryptoLibrary.js"></script>

    <script>
        $(document).ready(function() { // wichtig!
            //bind event Handler to submission form
            $("#loginform").submit(function(event) {
                event.preventDefault(); // prevent submission

                var data = $("#loginform :input").serializeArray();
                //alert( "Handler for .submit() called." );
                //alert("Input array: " +data.toString());
                var planePassword = data[1].value;
                var out = sjcl.hash.sha256.hash(planePassword);
                var hash = sjcl.codec.hex.fromBits(out); //tested hash against https://hashgenerator.de/  -->it works
                data[1].value = hash; // override plane password 

                $.post("../backendPhp/loginUser.php", {
                        email: data[0].value,
                        password: data[1].value,
                    },
                    function(returnedData) {
                        //alert("login happend; data = " + returnedData)

                        switch (returnedData) {
                            case "failed":
                                //alert("e-mail is already taken");
                                var emailErrorMessage = document.getElementById("invalidCredentialsErrorMessage");
                                emailErrorMessage.innerHTML = '<i class="fa fa-close animate__animated animate__shakeX"></i>Bitte prüfen Sie noch einmal Ihre Eingaben.';
                                break;
                            case "success":
                                //alert("registration successfull");
                                window.location.href = 'home.php';
                                break;
                            default:
                                alert("!!!!!!!!Unecpected server replie!!!!!!!!!!!!!!");
                                break;
                        }
                    }
                );
            });

        });
    </script>

</head>

<body>

    <!-- Kopfbereich -->
    <header class="w3-container w3-padding-16">
        <div class="w3-bar w3-light-gray">
            <div class="w3-bar-item w3-light-gray w3-center">
                <h1 class="myTitle">shop<strong class="myTitle">33</strong></h1>
                <p class="myTitle">Only the greatest discounts!</p>
            </div>
            <a href="home.php" class="myBarItem w3-button w3-hide-small w3-left"></i> Home</a>
            <a href="#überuns.html" class="myBarItem w3-button w3-hide-small"> Über uns</a>
            <a href="login.php" class="myBarItem w3-button w3-hide-small w3-right w3-light-gray"><i class="fas fa-user"></i> Login</a>
        </div>
    </header>

    <div class="container">
        <form class="form-horizontal" role="form" id="loginform" method="POST" action="../backendPhp/loginUser.php">
            <div class="w3-container w3-center">
                <div class="w3-panel w3-border-top w3-border-bottom">
                    <h3>Login </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="email">E-Mail</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                            <input type="email" name="email" class="form-control" id="email" placeholder="E-Mail-Adresse" required autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Password</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Passwort" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle" id="invalidCredentialsErrorMessage">
                            <!-- Put password error message here -->
                            <!-- <i class="fa fa-close animate__animated animate__shakeX"></i>Bitte prüfen Sie noch einmal Ihre Eingaben. -->
                        </span>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-top: 1.5rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> einloggen</button>
                    <a class="btn btn-link" href="register.php">Sie haben noch kein Benutzerkonto? Dann hier
                        registrieren!</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Fußleiste -->
    <footer class="w3-container w3-padding-16 w3-margin-top">
        <div class="w3-bar w3-light-gray">
            <span class="myBarItem w3-light-gray w3-left"> User online: 0</span>
            <a href="#kontakt.html" class="myBarItem w3-button w3-right"><i class="fas fa-envelope"></i>
                Kontakt</a>
            <a href="#impressum.html" class="myBarItem w3-button w3-right"> Impressum</a>
        </div>
    </footer>
</body>

</html>