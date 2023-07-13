<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['user_name'];

$conn = new mysqli('localhost', 'root', '', 'sdf_project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="discription.css">
</head>

<body>
    <p id="url"></p>
    <div id=descrip>
        <?php
        $projectname = $_GET['projectname'];

        //$globalpage = intval($_GET['globalpage']);
        
        //$page = $_GET['page'];
        $query = "DELETE FROM projects WHERE owner = '$username' AND name = '$projectname';";
        if ($conn->query($query) === TRUE) {
            echo '<script>alert("Project Deleted Successfully");'; //document.location = "homepage.php"</script>';
        } else {
            echo '<script>alert("Project Deletion Unsuccessful");document.location = "homepage.php"</script>';
        }

        $conn->close();

        ?>
    </div>
    <script>

    </script>

</html>