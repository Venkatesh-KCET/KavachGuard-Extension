<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'link_tracker'; // Replace with your actual database name

    // Connect to MySQL
    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    function domain_count($domain) {
        global $connection;
        $query = "SELECT count(*) as 'c' FROM links WHERE link LIKE '%$domain%'";
        $result = mysqli_query($connection, $query);
        return mysqli_fetch_assoc($result)["c"];
    }

    $data = array();
    $data["user"] = [];
    $data["urls"] = [];
    $data["domain"] = [];

    // Get the first day of the current month
    $currentMonth = date('Y-m-01', strtotime('1 month'));
    $previousMonth = date('Y-m-01');

    $query = "SELECT COUNT(DISTINCT ip) AS ip_count FROM links WHERE submission_time >= '$previousMonth' AND submission_time < '$currentMonth'";
    $result = mysqli_query($connection, $query);
    $data["user"]["this"] = mysqli_fetch_assoc($result)["ip_count"];

    $query = "SELECT count(*) as 'this' FROM links WHERE submission_time >= '$previousMonth' AND submission_time < '$currentMonth'";
    $result = mysqli_query($connection, $query);
    $data["urls"]["this"] = mysqli_fetch_assoc($result)["this"];

    $query = "SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(link, '://', -1), '/', 1) AS domain FROM links WHERE submission_time >= '$previousMonth' AND submission_time < '$currentMonth'";
    $result = mysqli_query($connection, $query);    
    $dom = [];
    $DOMcount = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $temp["url"] = $row['domain'];
        $dom[] = '"'.$row['domain'].'"';
        $DOMcount[] = $temp["count"] = domain_count($row['domain']);
        $data["domain"][] = $temp;
    }

    $currentMonth = date('Y-m-01');
    $previousMonth = date('Y-m-01', strtotime('-1 month'));

    $query = "SELECT COUNT(DISTINCT ip) AS ip_count FROM links WHERE submission_time >= '$previousMonth' AND submission_time < '$currentMonth'";
    $result = mysqli_query($connection, $query);
    $data["user"]["prev"] = mysqli_fetch_assoc($result)["ip_count"];

    $query = "SELECT count(*) as 'this' FROM links WHERE submission_time >= '$previousMonth' AND submission_time < '$currentMonth'";
    $result = mysqli_query($connection, $query);
    $data["urls"]["prev"] = mysqli_fetch_assoc($result)["this"];
    
    $data["blocked_url"] = [];
    $sql = "SELECT * FROM `links` LIMIT 10";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data["blocked_url"][] = $row["link"];
    }

    $data["calendar"] = [];
	$sql = "SELECT DAYNAME(submission_time) AS day, HOUR(submission_time) AS hour, COUNT(*) AS count 
			FROM links 
			GROUP BY day, hour 
			ORDER BY day, hour";
	$result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $temp = [];
        $temp["x"] = $row["hour"].'h';
        $temp["y"] = $row["count"];
		$data["calendar"][$row["day"]][] = $temp;
    }


    // Close the database connection
    // mysqli_close($connection);

    // // Return the data as JSON
    // header('Content-Type: application/json');
    // echo json_encode($data);
?>
<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
	<title>Kavach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo">
                                <span class="logo">
                                    <img src="assets/images/kavach-logo-white.png" alt="" height="60">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">PHOBOS</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Founder</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Welcome Kavach!</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /.modal -->
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Analytics</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Analytics</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-5">
                            <div class="d-flex flex-column h-100">
                                <div class="row h-100">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                                    <div class="flex-grow-1 text-truncate">
                                                        We have implemented this using <b>demo data</b> exclusively.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card-body-->
                                        </div>
                                    </div>
                                    <!-- end col-->
                                </div>
                                <!-- end row-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Users</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class=counter-value data-target=28.05><?php echo $data["user"]["this"]; ?></span></h2>
														<p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
														<i class="ri-arrow-up-line align-middle"></i> <?php echo $data["user"]["prev"]; ?>
                                                        </span> vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                                <i data-feather="users"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card-->
                                    </div>
                                    <!-- end col-->

                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Blocked Images</p>
														<h2 class="mt-4 ff-secondary fw-semibold"><span class=counter-value data-target=97.66><?php echo $data["urls"]["this"]; ?></span></h2>
														<p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
														<i class="ri-arrow-down-line align-middle"></i> <?php echo $data["urls"]["prev"]; ?>
														</span> vs. previous month
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-danger rounded-circle fs-2">
                                                                <i data-feather="activity"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card-->
                                    </div>
                                    <!-- end col-->
                                </div>
                                <!-- end row-->
                            </div>
                        </div>
                        <!-- end col-->

                        <div class="col-xxl-7">
                            <div class="row h-100">
                                <div class="col-12">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Sessions by Countries</h4>
                                            <div>
                                                <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                    ALL
                                                </button>
                                                <button type="button" class="btn btn-soft-primary btn-sm shadow-none">
                                                    1M
                                                </button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                    6M
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div>
                                                <div id="countries_charts" data-colors='["--vz-primary", "--vz-primary", "--vz-info", "--vz-info", "--vz-danger", "--vz-primary", "--vz-primary", "--vz-warning", "--vz-primary", "--vz-primary"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col-->

                            </div>
                            <!-- end row-->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class="row">

                        <div class="col-12">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Audiences Sessions by Country</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Week<i class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">Current Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card header -->
                                <div class="card-body p-0">
                                    <div>
                                        <div id="audiences-sessions-country-charts" data-colors='["--vz-success", "--vz-info"]' class="apex-charts" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top Pages</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">Current Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col" style="width: 62;">Blocked URLs</th>
                                                    <th scope="col">Count</th>
                                                </tr>
                                            </thead>
                                            <tbody>

<?php 

foreach($data["domain"] as $domain) {
    echo '                                                <tr>
    <td>
        <a href="javascript:void(0);">' . $domain["url"] . '</a>
    </td>
    <td>' . $domain["count"] . '</td>
</tr>
<!-- end -->';

}

?>
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end -->
                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->




                    <div class="row">
                        <div class="col-12">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Report</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Last Week</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                                <a class="dropdown-item" href="#">Current Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle table-borderless table-centered table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col" style="width: 62;">Image URLs</th>
                                                    <th scope="col">Safe / Unsafe</th>
                                                </tr>
                                            </thead>
                                            <tbody>

<?php 


$result = mysqli_query($connection, "SELECT * FROM `report` ORDER BY `report`.`id` DESC LIMIT 10");

$data["report"] = [];
while ($row = mysqli_fetch_assoc($result)) {
    echo '                                                <tr>
    <td>
        <a href="javascript:void(0);">' . $row["url"] . '</a>
    </td>';
    if($row["safe"] == 1)
    echo '<td>Safe</td>';
    else
    echo '<td>Unsafe</td>';
echo '</tr>
<!-- end -->';

}

?>
                                            </tbody>
                                            <!-- end tbody -->
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end -->
                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Kavach.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by PHOBOS
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Dashboard init -->
<script>
function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t) return (t = JSON.parse(t)).map(function(e) {
            var t = e.replace(" ", "");
            return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
        });
        console.warn("data-colors atributes not found on", e)
    }
}
var worldemapmarkers = "";

function loadCharts() {
    var e = getChartColorsArray("users-by-country");
    e && (document.getElementById("users-by-country").innerHTML = "", worldlinemap = "", worldlinemap = new jsVectorMap({
        map: "world_merc",
        selector: "#users-by-country",
        zoomOnScroll: !1,
        zoomButtons: !1,
        markers: [{
            name: "Greenland",
            coords: [72, -42]
        }, {
            name: "Canada",
            coords: [56.1304, -106.3468]
        }, {
            name: "Brazil",
            coords: [-14.235, -51.9253]
        }, {
            name: "Egypt",
            coords: [26.8206, 30.8025]
        }, {
            name: "Russia",
            coords: [61, 105]
        }, {
            name: "China",
            coords: [35.8617, 104.1954]
        }, {
            name: "United States",
            coords: [37.0902, -95.7129]
        }, {
            name: "Norway",
            coords: [60.472024, 8.468946]
        }, {
            name: "Ukraine",
            coords: [48.379433, 31.16558]
        }],
        lines: [{
            from: "Canada",
            to: "Egypt"
        }, {
            from: "Russia",
            to: "Egypt"
        }, {
            from: "Greenland",
            to: "Egypt"
        }, {
            from: "Brazil",
            to: "Egypt"
        }, {
            from: "United States",
            to: "Egypt"
        }, {
            from: "China",
            to: "Egypt"
        }, {
            from: "Norway",
            to: "Egypt"
        }, {
            from: "Ukraine",
            to: "Egypt"
        }],
        regionStyle: {
            initial: {
                stroke: "#9599ad",
                strokeWidth: .25,
                fill: e,
                fillOpacity: 1
            }
        },
        lineStyle: {
            animation: !0,
            strokeDasharray: "6 3 6"
        }
    }))
}
window.onresize = function() {
    setTimeout(() => {
        loadCharts()
    }, 0)
}, loadCharts();
var barchartCountriesColors = getChartColorsArray("countries_charts");

function generateData(e, t) {
    for (var a = 0, o = []; a < e;) {
        var r = (a + 1).toString() + "h",
            n = Math.floor(Math.random() * (t.max - t.min + 1)) + t.min;
        o.push({
            x: r,
            y: n
        }), a++
    }
    return o
}
barchartCountriesColors && (options = {
    series: [{
        data: [<?php echo implode(", ", $DOMcount); ?>],
        name: "Sessions"
    }],
    chart: {
        type: "bar",
        height: 436,
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: !0,
            distributed: !0,
            dataLabels: {
                position: "top"
            }
        }
    },
    colors: barchartCountriesColors,
    dataLabels: {
        enabled: !0,
        offsetX: 32,
        style: {
            fontSize: "12px",
            fontWeight: 400,
            colors: ["#adb5bd"]
        }
    },
    legend: {
        show: !1
    },
    grid: {
        show: !1
    },
    xaxis: {
        categories: [<?php echo implode(", ", $dom); ?>]
    }
}, (chart = new ApexCharts(document.querySelector("#countries_charts"), options)).render());
var columnoptions, options, chart, chartHeatMapBasicColors = getChartColorsArray("audiences-sessions-country-charts"),
    chartAudienceColumnChartsColors = (chartHeatMapBasicColors && (options = {
        series: [{
            name: "Sat",
            data: <?php echo json_encode($data["calendar"]["Saturday"]) ?>,
        }, {
            name: "Fri",
            data: <?php echo json_encode($data["calendar"]["Monday"]) ?>
        }, {
            name: "Thu",
            data: <?php echo json_encode($data["calendar"]["Thursday"]) ?>
        }, {
            name: "Wed",
            data: <?php echo json_encode($data["calendar"]["Wednesday"]) ?>
        }, {
            name: "Tue",
            data: <?php echo json_encode($data["calendar"]["Tuesday"]) ?>
        }, {
            name: "Mon",
            data: <?php echo json_encode($data["calendar"]["Monday"]) ?>
        }, {
            name: "Sun",
            data: <?php echo json_encode($data["calendar"]["Sunday"]) ?>
        }],
        chart: {
            height: 400,
            type: "heatmap",
            offsetX: 0,
            offsetY: -8,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            heatmap: {
                colorScale: {
                    ranges: [{
                        from: 0,
                        to: 50,
                        color: chartHeatMapBasicColors[0]
                    }, {
                        from: 51,
                        to: 100,
                        color: chartHeatMapBasicColors[1]
                    }]
                }
            }
        },
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !0,
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: 20,
            markers: {
                width: 20,
                height: 6,
                radius: 2
            },
            itemMargin: {
                horizontal: 12,
                vertical: 0
            }
        },
        colors: chartHeatMapBasicColors,
        tooltip: {
            y: [{
                formatter: function(e) {
                    return void 0 !== e ? e.toFixed(0) + "k" : e
                }
            }]
        }
    }, (chart = new ApexCharts(document.querySelector("#audiences-sessions-country-charts"), options)).render()), getChartColorsArray("audiences_metrics_charts")),
    dountchartUserDeviceColors = (chartAudienceColumnChartsColors && (columnoptions = {
        series: [{
            name: "Last Year",
            data: [25.3, 12.5, 20.2, 18.5, 40.4, 25.4, 15.8, 22.3, 19.2, 25.3, 12.5, 20.2]
        }, {
            name: "Current Year",
            data: [36.2, 22.4, 38.2, 30.5, 26.4, 30.4, 20.2, 29.6, 10.9, 36.2, 22.4, 38.2]
        }],
        chart: {
            type: "bar",
            height: 309,
            stacked: !0,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "20%",
                borderRadius: 6
            }
        },
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            fontWeight: 400,
            fontSize: "8px",
            offsetX: 0,
            offsetY: 0,
            markers: {
                width: 9,
                height: 9,
                radius: 4
            }
        },
        stroke: {
            show: !0,
            width: 2,
            colors: ["transparent"]
        },
        grid: {
            show: !1
        },
        colors: chartAudienceColumnChartsColors,
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisTicks: {
                show: !1
            },
            axisBorder: {
                show: !0,
                strokeDashArray: 1,
                height: 1,
                width: "100%",
                offsetX: 0,
                offsetY: 0
            }
        },
        yaxis: {
            show: !1
        },
        fill: {
            opacity: 1
        }
    }, (chart = new ApexCharts(document.querySelector("#audiences_metrics_charts"), columnoptions)).render()), getChartColorsArray("user_device_pie_charts"));
dountchartUserDeviceColors && (options = {
    series: [78.56, 105.02, 42.89],
    labels: ["Desktop", "Mobile", "Tablet"],
    chart: {
        type: "donut",
        height: 219
    },
    plotOptions: {
        pie: {
            size: 100,
            donut: {
                size: "76%"
            }
        }
    },
    dataLabels: {
        enabled: !1
    },
    legend: {
        show: !1,
        position: "bottom",
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: 0,
        markers: {
            width: 20,
            height: 6,
            radius: 2
        },
        itemMargin: {
            horizontal: 12,
            vertical: 0
        }
    },
    stroke: {
        width: 0
    },
    yaxis: {
        labels: {
            formatter: function(e) {
                return e + "k Users"
            }
        },
        tickAmount: 4,
        min: 0
    },
    colors: dountchartUserDeviceColors
}, (chart = new ApexCharts(document.querySelector("#user_device_pie_charts"), options)).render());
</script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>