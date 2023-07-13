<?php
function test_input($data)
{
    $data = trim($data);
    $data = preg_replace('/\s+/', ' ', $data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!empty($_POST["uname"]) && !empty($_POST["pw"])) {

    $username = test_input($_POST['uname']);

    $password = test_input($_POST['pw']);

    if (!preg_match("/^[A-Za-z][A-Za-z0-9_]{7,29}$/", $username)) {

    } else if (strlen($password) < 8 || strlen($password) > 15) {

    } else {

        $conn = new mysqli('localhost', 'root', '', 'sdf_project');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {

            $query = "SELECT * FROM users WHERE user_name = '$username'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $storedPassword = $row['pass'];

                if ($password == $storedPassword) {

                    session_start();
                    $_SESSION['user_name'] = $username;
                    header("Location: homepage.php");
                    exit;
                } else {

                    echo '<script>alert("Username or Password Are Incorrect");document.location = "login.php"</script>';
                }
            } else {

                echo '<script>alert("User Not Found");document.location = "index.php"</script>';
            }

            $conn->close();
        }
    }

}
?>