<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bakery Management - Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/1a953be97e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./assets/css/login.css">
    </head>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/validateForm.js"></script>

</head>

<body>
    <!-- <div id="hello"></div> -->
    <div class="container">

        <div id="login-form" class="card m-auto p-2">
            <div class="card-body">
                <form name="login-form" class="login-form" action="index.php" method="post" onsubmit="return validateCredentials();">
                    <div class="logo">
                        <img src="./assets/images/prof.jpg" class="profile" />
                        <h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
                    </div> <!-- logo class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                        </div>
                        <input name="email" id="typeEmailX" type="email" class="form-control" placeholder="Email" onkeyup="validate();" required>
                    </div> <!--input-group class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input name="password" id="typePasswordX" type="password" class="form-control" placeholder="password" onkeyup="validate();" required>
                    </div> <!-- input-group class -->
                    <div class="form-group">
                        <button class="btn btn-default btn-block btn-custom w-100">Login</button>
                    </div>
                </form><!-- form close -->

            </div> <!-- cord-body class -->






            <div class="card-footer">
                <div class="text-center">
                    <a class="text-light" onclick="displaySignUp();" style="cursor: pointer;">Don't have an account? Sign Up</a>
                </div>
            </div> <!-- cord-footer class -->
        </div> <!-- card class -->

        <div id="sign-up-form" class="card m-auto p-2" style="display: none;">
            <div class="card-body">
                <form name="sign-up-form" class="sign-up-form" action="login.php" method="post" onsubmit="return validateAndSetup();">
                    <div class="logo">
                        <img src="./assets/images/prof.jpg" class="profile" />
                        <h1 class="logo-caption"><span class="tweak">S</span>ign up</h1>
                    </div> <!-- logo class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                        </div>
                        <input name="username" id="username" type="text" class="form-control" placeholder="Username" required>
                    </div> <!-- input-group class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                        </div>
                        <input name="email" id="email" type="email" class="form-control" placeholder="Email" required>
                    </div> <!--input-group class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input name="password" id="password" type="password" class="form-control" placeholder="password" required>
                    </div> <!-- input-group class -->
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input name="password-confirm" id="confirmPassword" type="password" class="form-control" placeholder="Confirm Password" required>
                    </div> <!-- input-group class -->
                    <div class="input-group form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin" value=1>
                            <label class="form-check-label">Admin</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default btn-block btn-custom w-100">Sign Up</button>
                    </div>
                </form><!-- form close -->

            </div> <!-- cord-body class -->
        </div> <!-- card class -->

    </div> <!-- container class -->
</body>

</html>