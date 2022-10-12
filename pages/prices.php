<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fare Prices | FastFare</title>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/private.css">
    <link rel="stylesheet" href="../styles/master.css">
    <link rel="stylesheet" href="../styles/prices.css">
</head>

<body>
    <?php
    include 'fragments/header.php';
    include 'fragments/sidebar.php';
    ?>

    <div class="content">
        <h4>Fare Prices</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fare Prices</li>
            </ol>
        </nav>
        <div id="prices">
            <div class="d-flex ">
                <div>
                    <label for="area">Area:</label>
                    <select id="area" class="form-select" aria-label="Default select example">
                        <option selected>Select an Area</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div>
                    <label for="route">Route:</label>
                    <select id="route" class="form-select" aria-label="Default select example">
                        <option selected>Select an Route</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <hr>
            <table>
                <tr>
                    <th>Type</th>
                    <th>Intial Kilometer</th>
                    <th>Base Price (Initial Km)</th>
                    <th>Price per Kilometer</th>
                </tr>
                <tr>
                    <td>Tricycle</td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                </tr>
                <tr>
                    <td>Jeepney</td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                </tr>
                <tr>
                    <td>Modern Jeepney</td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                </tr>
                <tr>
                    <td>Bus</td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                </tr>
                <tr>
                    <td>Other PUVs</td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                    <td><input type="number"></td>
                </tr>
            </table>
            <button class="btn btn-outline-dark" style="margin: 5% auto; display: flex;">Update</button>
        </div>
    </div>
</body>
<script>
    $("#navFare").addClass("active");
    $("#navFare").removeClass("link-dark");
</script>

</html>