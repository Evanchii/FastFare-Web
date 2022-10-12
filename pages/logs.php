<?php
require_once(dirname(dirname(__FILE__)) . '../vendor/autoload.php');
require_once dirname(dirname(__FILE__)) . '../vendor/fakerphp/faker/src/autoload.php';

$faker = Faker\Factory::create();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs | FastFare</title>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/js/bootstrap-toaster.js" crossorigin="anonymous"></script> -->

    <!-- <script type="importmap">
        { "imports": {
        "bs-toaster": "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/js/bootstrap-toaster.js"
        } }
    </script> -->

    <link rel="stylesheet" href="../styles/private.css">
    <link rel="stylesheet" href="../styles/application.css">
    <link rel="stylesheet" href="../styles/master.css">
</head>

<body>
    <?php
    include 'fragments/header.php';
    include 'fragments/sidebar.php';
    ?>
    <div class="content">
        <h4>Activity Logs</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
            </ol>
        </nav>

        <!-- ID, Time & Date, Name, Contact Details, Actions -->
        <table class="table">
            <tr>
                <th class="col">IP Address</th>
                <th class="col">Date and Time</th>
                <th class="col">Category</th>
                <th class="col">Details</th>
            </tr>
            <!-- <tr>
                <td class="col">1</td>
                <td class="col">01/01/2000<br /><small class="d-block">00:00:00</small></td>
                <td class="col">Dela Cruz, Juan Martinez</td>
                <td class="col">09123456789<br /><small class="d-block">sample@email.com</small></td>
                <td class="col">
                    <button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <button type="button" class="btn btn-outline-success"><i class="fa-solid fa-check"></i></button>
                    <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-xmark"></i></button>
                </td>
            </tr> -->
            <?php
            for ($i = 1; $i < 11; $i++) {
                $dt = isset($dt) ? $dt : '-5 years';
                $dt = $faker->dateTimeBetween($startDate = $dt, $endDate = 'now');
                $d = $dt->format("m/d/Y");
                $t = $dt->format("H:i:s");
                echo <<<HTML
                <tr>
                    <td class="col">{$faker->ipv4()}<br><small>{$faker->ipv6()}</small></td>
                    <td class="col">{$d}<br /><small class="d-block">{$t}</small></td>
                    <td class="col">{$faker->randomElement(['Account Management', 'Driver Application', 'Balance Management', 'Driver Booking', 'Discount Application'])}</td>
                    <td class="col">{$faker->text()}</td>
                </tr>
                HTML;
            }
            ?>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="modal modal-lg fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Application Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <?php
                        echo <<<HTML
                            <div class="d-flex">
                                <div>
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" value="{$faker->firstName()}">
                                </div>
                                <div>
                                    <label for="">Middle Name</label>
                                    <input type="text" class="form-control" value="{$faker->lastName()}">
                                </div>
                                <div>
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" value="{$faker->lastName()}">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" value="{$faker->address()}">
                                </div>
                                <div>
                                    <label for="">Date of Birth</label>
                                    <input type="text" class="form-control" value="{$faker->date($format = 'm/d/Y')}">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <label for="">Email Address</label>
                                    <input type="text" class="form-control" value="{$faker->email()}">
                                </div>
                                <div>
                                    <label for="">Contact Number</label>
                                    <input type="text" class="form-control" value="{$faker->phoneNumber()}">
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <label for="">Discount Application</label>
                                    <input type="text" class="form-control" value="{$faker->randomElement(['None', 'Applying', 'Student', 'Senior Citizen', 'PWD'])}">
                                </div>
                                <div>
                                    <label for="">Driver Application</label>
                                    <input type="text" class="form-control" value="{$faker->randomElement(['None', 'Applying'])}">
                                </div>
                            </div>
                        HTML;
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" data-type="WARNING" class="btn btn-warning btn-action" data-bs-dismiss="modal">Disable</button>
                    <button type="button" data-type="DANGER" class="btn btn-danger btn-action" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $("#navActivity").addClass("active");
    $("#navActivity").removeClass("link-dark");
</script>
<script type="module">
    import {
        Toaster,
        ToasterPosition,
        ToasterTimer,
        ToasterType,
    } from "https://hummal.github.io/bs-toaster/dist/js/Toaster.bundle.js";

    const simpleToaster = new Toaster({
        delay: 0,
    });

    const btns = document.querySelectorAll(".btn-action");
    for (const btn of btns) {
        const typePair = Object.entries(ToasterType).find((entry) => {
            const [key, value] = entry;
            return key === btn.dataset.type;
        });
        const type = typePair[0];
        console.log(type);


        btn.addEventListener("click", (e) => {
            var msg = (type == "WARNING") ? "Successfully Disabled Account!" : "Successfully Deleted Account";
            var title = (type == "WARNING") ? "Disabled" : "Deleted";
            simpleToaster.create(title, msg, {
                type: typePair[1],
                animation: true,
            });
        });
    }
</script>

</html>