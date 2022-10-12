<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | FastFare</title>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/master.css">

    <style>
        .login-container {
            min-height: 50vh;
            width: 50vw;
            padding: 30px;
            background-color: white;
            background-image: url("../assets/art_login.png");
            background-size: 40%;
            background-position: bottom left;
            background-repeat: no-repeat;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
            -webkit-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
        }

        .content {
            width: 50%;
        }

        .login-container img {
            width: 15%;
        }

        .login-container h4 {
            font-weight: 600;
        }

        .bottom-buttons {
            display: flex;
            justify-content: space-between;
            margin: 16px 0px;
        }

        body {
            background: radial-gradient(circle at 75% 0%, #21b5eb, #15c499, #129431);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container border border-1 rounded-3">
        <div class="content">
            <img src="../assets/app_logo.png" alt="">
            <h4>FastFare | Login</h4>
            <p>Welcome back user!</p>
            <form action="">
                <label class="visually-hidden" for="autoSizingInputGroup">Email</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-envelope"></i></div>
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Email">
                </div>
                <br>
                <label class="visually-hidden" for="autoSizingInputGroup">Email</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fa-solid fa-lock"></i>&nbsp;</div>
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Password">
                </div>
                <br>
                <button type="button" onclick="window.location.href = 'dashboard.php';" class="btn btn-primary">Login</button>
                <div class="bottom-buttons">
                    <a href="">Forgot Password</a>
                    <div>
                        <input type="checkbox" name="rmbme" id="rmbme">
                        <label for="rmbme">Remember Me</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>