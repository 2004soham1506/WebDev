<?php
function test_input($data)
{
    $data = trim($data);
    $data = preg_replace('/\s+/', ' ', $data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!empty($_POST["fname"]) && !empty($_POST["mail"]) && !empty($_POST["uname"]) && !empty($_POST["pw"]) && !empty($_POST["info"])) {

    $f_name = test_input($_POST['fname']);
    $email = test_input($_POST['mail']);
    $u_name = test_input($_POST['uname']);
    $pass = test_input($_POST['pw']);
    $contact = test_input($_POST['info']);

    if (!preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $f_name) && (strlen($f_name) < 5 || strlen($f_name) > 50)) {
    } else if (!preg_match("/^[A-Za-z][A-Za-z0-9_]{7,14}$/", $pass)) {
    } else if (!preg_match("/^[A-Za-z][A-Za-z0-9_]{7,29}$/", $u_name)) {
    } else if (!preg_match("/^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/", $email)) {
    } else if (!preg_match("/^(\d{3})[- ]?(\d{3})[- ]?(\d{4})$/", $contact)) {
    } else {

        $conn = new mysqli('localhost', 'root', '', 'sdf_project');
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        } else {

            $query = "SELECT * FROM users WHERE user_name = '$u_name' OR email = '$email' OR contact = '$contact'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {

                echo '<script>alert("Some Credentials Already In Use");document.location = "index.php"</script>';
            } else {


                $query2 = "INSERT INTO users(f_name, email, user_name, pass, contact) VALUES(?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("sssss", $f_name, $email, $u_name, $pass, $contact);
                if ($stmt->execute()) {

                    session_start();
                    $_SESSION['user_name'] = $u_name;
                    echo '<script>alert("Account Created Successfully");document.location = "homepage.php"</script>';
                } else {

                    echo '<script>alert("Error: " . $stmt->error"</script>';
                }
                $stmt->close();
                $conn->close();
            }
        }
    }
}
?>