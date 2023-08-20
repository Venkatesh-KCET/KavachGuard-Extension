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
    while ($row = mysqli_fetch_assoc($result)) {
        $temp["url"] = $row['domain'];
        $temp["count"] = domain_count($row['domain']);
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
			WHERE submission_time BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() 
			GROUP BY day, hour 
			ORDER BY day, hour";
	$result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
		$data["calendar"][$row["day"]][$row["hour"]] = $row["hour"];
    }


    // Close the database connection
    mysqli_close($connection);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);