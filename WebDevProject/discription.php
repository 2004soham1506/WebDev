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
} else {

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
            if (isset($_GET['name'])) {
                $projectname = $_GET['name'];
                $query = "SELECT * FROM projects INNER JOIN users ON projects.owner = users.user_name WHERE name = '$projectname' AND (NOT name = '') ;";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div id = name>" . $projectname . "<br><br></div> <br><br><br>";

                    echo "<div id = discription>" . $row["description"] . "<br><br><br><br></div>";

                    if ($username === $row['owner']) {

                    } else {
                        echo "<br><br>Owner name : &nbsp <div id='bold'>". $row['f_name'] ."</div>";
                        echo "<br>Email : &nbsp <div id='bold'>". $row['email']."</div>";
                        echo "<br>Whatsapp Group Link : &nbsp <div id='bold'>". $row['group_link']."</div>";
                        
                        
                        // echo "<br><br><input type='text' id = 'link' value='" . $row["group_link"] . "'><br>";

                        // echo '<button id = "boton" onclick="kopy()">Copy WhatsApp <br> Group Link</button>';
                    }
                } else {
                    echo "no records";
                }
            }
}



?>
    </div>
    <script>
        // document.getElementById("url").innerText = "URL: " + window.location.href;
        function kopy() {

            var copyText = document.getElementById("link");
            copyText.select();
            copyText.setSelectionRange(0, 99);

            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
    </script>

</html>