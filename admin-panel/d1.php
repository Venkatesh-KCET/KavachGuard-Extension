<?php
// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "link_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = $_POST["link"];
    $reason = $_POST['reason'];
    print_r($_POST);

    if($_POST["type"] == "unsafe")
        $sql = "INSERT INTO `report` (`id`, `url`, `reason`, `safe`, `unsafe`) VALUES (NULL, '$link', '$reason', '0', '1');";
    else
        $sql = "INSERT INTO `report` (`id`, `url`, `reason`, `safe`, `unsafe`) VALUES (NULL, '$link', '$reason', '1', '0');";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Perform the redirect
        $redirect_url = "http://localhost/kavach/thank-you.jpg";
        header("Location: $redirect_url");
        exit; // Make sure to exit after the redirect

        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    $link = $_GET["link"];
}


// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="modal-open">

<!-- Modal -->
<div class="modal fade show" id="myModal" style="display: block;" aria-modal="true" role="dialog">
<!-- /<div class="modal fade show" id="myModal"> -->
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group">
            <label for="inputText">Reason:</label>
            <input type="text" class="form-control" name="reason" id="inputText">
            <input type="hidden" name="link" value="<?php echo $link; ?>">
          </div>
          <div class="form-group">
            <di class="row">
                <div class="col-6">
                    <input type="submit" name="type" value="unsafe" class="btn w-100 btn-danger">
                </div>
                <div class="col-6">
                    <input type="submit" name="type" value="safe" class="btn w-100 btn-success">
                </div>
            </di>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<div class="modal-backdrop fade show"></div>

<!-- Include Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
