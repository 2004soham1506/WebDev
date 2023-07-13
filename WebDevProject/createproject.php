<?php

function test_input($data)
{
    $data = trim($data);
    $data = preg_replace('/\s+/', ' ', $data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$pname = test_input($_POST['name']);
$pdescription = test_input($_POST['des']);
$plink = test_input($_POST['link']);


$conn = new mysqli('localhost', 'root', '', 'sdf_project');
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM projects WHERE name = '$pname' OR group_link = '$plink'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {

    echo '<script>alert("Similar Credentials Exist");document.location = "addproject.php"</script>';
} else {

    session_start();
    $user = $_SESSION['user_name'];
    $query2 = "INSERT INTO projects(name, owner, description, group_link) VALUES(?, ?, ?, ?)";
    $stmt = $conn->prepare($query2);
    $stmt->bind_param("ssss", $pname, $user, $pdescription, $plink);
    if ($stmt->execute()) {

        echo '<script>alert("Project Created Successfully");window.opener.location.reload();window.close();</script>';
    } else {

        echo '<script>alert("Error: " . $stmt->error"</script>';
    }
    $stmt->close();
    $conn->close();
}
?>