<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | FastFare</title>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/private.css">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="../styles/master.css">

    <script src="../node_modules/chart.js/dist/chart.js"></script>
</head>

<body>
    <?php
    include 'fragments/header.php';
    include 'fragments/sidebar.php';
    ?>
    <div class="content">
        <h4>Admin Dashboard</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div id="stats">
            <div class="card card-2">
                <h6>Income Balance</h6>
                <h4>Php 3,360.24</h4>
            </div>

            <div class="card card-2">
                <h6>No. of Transactions</h6>
                <h4>5,539 / daily</h4>
            </div>

            <div class="card card-2">
                <h6>No. of Active Drivers</h6>
                <h4>634</h4>
            </div>

            <div class="card card-1">
                <canvas id="trendChart"></canvas>
            </div>

            <div class="card card-2">
                <canvas id="users"></canvas>
            </div>

            <div class="card card-2">
                <canvas id="noPUV"></canvas>
            </div>

            <div class="card card-1">
                <canvas id="PUVBreakdown"></canvas>
            </div>

        </div>
    </div>

</body>
<script>
    function numbers(count, max) {
        var data = [];
        for (i = 0; i < count; ++i) {
            data[i] = Math.round(Math.random() * max);
        }

        return data;
    }

    function colors(count) {
        var data = [];
        for (i = 0; i < count; ++i) {
            // data[i] = "#" + Math.floor(Math.random() * 16777215).toString(16);
            data[i] = genColor();
        }

        return data;
    }

    //Generate HSL Pastel Color
    function genColor() {
        var h = 360 * Math.random();
        var s = (25 + 70 * Math.random());
        var l = (85 + 10 * Math.random());
        return hslToHex(h, s, l);
    }

    function hslToHex(h, s, l) {
        h /= 360;
        s /= 100;
        l /= 100;
        let r, g, b;
        if (s === 0) {
            r = g = b = l; // achromatic
        } else {
            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1 / 6) return p + (q - p) * 6 * t;
                if (t < 1 / 2) return q;
                if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
                return p;
            };
            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1 / 3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1 / 3);
        }
        const toHex = x => {
            const hex = Math.round(x * 255).toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        };
        return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
    }
</script>

<script>
    $("#navDash").addClass("active");
    $("#navDash").removeClass("link-dark");

    var width = $(".card-1").width();
    $("#trendChart").height(width * 0.60);
    $("#trendChart").width(width);

    var width = $(".card-2").width();
    $("#noPUV").height(width * 0.60);
    $("#noPUV").width(width);

    puvColors = colors(5);

    // TrendChart
    const trendsLabel = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    const trendsData = {
        labels: trendsLabel,
        datasets: [{
                label: 'Incoming Balance',
                data: numbers(7, 3360),
                borderColor: "#ff6384",
                backgroundColor: "#ff6384",
            },
            {
                label: 'No. of Transactions',
                data: numbers(7, 5539),
                borderColor: "#4bc0c0",
                backgroundColor: "#4bc0c0",
            },
            {
                label: 'No. of Active Drivers',
                data: numbers(7, 634),
                borderColor: "#36a2eb",
                backgroundColor: "#36a2eb"
            },
        ]
    };

    trendsConfig = {
        type: 'line',
        data: trendsData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Weekly Trends'
                }
            }
        },
    };

    const trends = new Chart(
        document.getElementById('trendChart').getContext('2d'),
        trendsConfig
    );

    // No Users
    const usersData = {
        labels: ['Passengers', 'Drivers'],
        datasets: [{
            label: 'Users',
            data: numbers(2, 1000),
            backgroundColor: colors(2),
        }]
    };

    const usersConfig = {
        type: 'pie',
        data: usersData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'FastFare Users'
                }
            }
        },
    };

    const users = new Chart(
        document.getElementById('users').getContext('2d'),
        usersConfig
    );
    // No. of PUVs

    const NoPUVData = {
        labels: ['Tricycle', 'Jeepney', 'Modern Jeepney', 'Bus', 'PUV'],
        datasets: [{
            label: 'No. of PUVs',
            data: numbers(5, 100),
            backgroundColor: puvColors,
        }]
    };

    const NoPUVConfig = {
        type: 'doughnut',
        data: NoPUVData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'No. of PUVs'
                }
            }
        },
    };

    const NoPUV = new Chart(
        document.getElementById('noPUV').getContext('2d'),
        NoPUVConfig
    );

    // Income per PUV

    const labels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    const revData = {
        labels: labels,
        datasets: [{
                label: 'Tricycle',
                data: numbers(7, 100),
                backgroundColor: puvColors[0],
            },
            {
                label: 'Jeepney',
                data: numbers(7, 100),
                backgroundColor: puvColors[1],
            },
            {
                label: 'Modern Jeepney',
                data: numbers(7, 100),
                backgroundColor: puvColors[2],
            },
            {
                label: 'Bus',
                data: numbers(7, 100),
                backgroundColor: puvColors[3],
            },
            {
                label: 'Other PUVs',
                data: numbers(7, 100),
                backgroundColor: puvColors[4],
            },
        ]
    };

    const revConfig = {
        type: 'bar',
        data: revData,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Income per PUV'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    };

    const revenue = new Chart(
        document.getElementById('PUVBreakdown').getContext('2d'),
        revConfig
    );
</script>

</html>