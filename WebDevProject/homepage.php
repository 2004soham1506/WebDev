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
        <title>Kollabor8</title>
        <link rel="icon" type="image/x-icon" href="images/Logo.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <link rel="stylesheet" href="common.css">
        <link rel="stylesheet" href="homepage.css">

    </head>

    <body>
        <div id="header">
            <img class="logo" src="Images\Logo.png">
            <img class="mast" src="Images\Masthead.png">
            <button class="logout" onclick="logout()">Log Out</button>
            <div id="usrname">
            <?php
                echo "$username"; 
            ?></div>
        </div>

        <div id="global">
            <div id="uppper">
                <div id="uper">GLOBAL PROJECTS</div>
            </div>
<?php
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        $globalpage = isset($_GET['globalpage']) ? intval($_GET['globalpage']) : 1;
        $offset = ($globalpage - 1) * 10;

        $query = "SELECT project_id FROM projects WHERE NOT (owner = '$username') ;";

        $resultglobal = $conn->query($query);

        $totalglobalpages = ceil($resultglobal->num_rows / 10);

        $query = "SELECT * FROM projects WHERE NOT (owner = '$username') ORDER BY project_id DESC LIMIT 10 OFFSET $offset ;";
        $resultglobal = $conn->query($query);

        //$totalglobalpages = ceil($resultglobal->num_rows / 5);
        if ($resultglobal->num_rows > 0) {
            echo "<div id='lnavbar'>";
            if($globalpage <  $totalglobalpages){  
                echo "<div id='lrownex'><a href='homepage.php?globalpage=". ($globalpage + 1) ."&page=".  ($page)  ."'>next</a> "."</div>" ;
            }
            if($globalpage > 1){  
                echo "<div id='lrowpre'><a id="."'pre'"." href='homepage.php?globalpage=".  ($globalpage - 1) ."&page=".  ($page) ."'> previous </a> "."</div>";
            }
            
            echo "</div>";
            while($row = $resultglobal->fetch_assoc()) {
            echo "<div id='lrow' onmouseover=".'"'."changescreen("."'". $row["name"]."'".")".'">' .$row["owner"]. "  :  ". $row["name"]."<br>"."</div>";
            }

  
}
else {
    
    if($globalpage > 1){  
        echo "<a href='homepage.php?globalpage=".  ($globalpage - 1) ."&page=".  ($page) ."'> previous </a> " ;
    }
    echo "</div>";
}
?>
        </div>

      
        <div id="screen">
        <iframe id="scrin"  src="/WebDevProject/discription.php">  
        
        </iframe>
        </div>
    
    

        <div id="myproject">
            <button class="addproject" onclick="addproject()">New Project</button>
            <div id="upper" >
                <div id="uper"> MY PROJECTS</div>
                </div>
                
                <div id="myprojs">
                <?php

                
                $offset = ($page - 1) * 10;

                $query = "SELECT * FROM users INNER JOIN projects ON projects.owner = users.user_name WHERE user_name = '$username';";

                $result = $conn->query($query);

                $totalpages = ceil($result->num_rows / 10);

            
                $query = "SELECT * FROM users INNER JOIN projects ON projects.owner = users.user_name WHERE user_name = '$username' ORDER BY project_id DESC LIMIT 10 OFFSET $offset ;";
                $result = $conn->query($query);
            
            
                if ($result->num_rows > 0) {
                    echo "<div id='rnavbar'>";
                    if ($page > 1) {
                        echo "<div id='rrowpre'><a href='homepage.php?page=". ($page - 1) . "&globalpage=".  ($globalpage)  ."'> previous </a> </div>" ;
                    }
                    if ($page < $totalpages) {
                        echo "<div id='rrownex'><a href='homepage.php?page=". ($page + 1) . "&globalpage=".  ($globalpage) ."'>next</a> </div>" ;
                    }
                    echo "</div>";
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<div id='rrow' onmouseover=".'"'."changescreen("."'". $row["name"]."'".")".'">' . $row["name"] . '<div id="delet" onclick='.'"'."dele("."'". $row["name"]."'". ")".'"' .'> <img class="remoove" src="Images\remoove.png"></div>'."<br>" . "</div>";
                    }

                  
                } else {
                    
                    if ($page > 1) {
                        echo "<a href='homepage.php?page=". ($page - 1) . "&globalpage=".  ($globalpage)  ."'> previous </a> " ;
                    }
                    echo "<div id='non'></div>";
                }
                $conn->close();
}
?>
        </div>
    </div>

    <footer>
      <div id="dropdown" >
            <button class="dropbutton" >Credits</button>
            <div class="credits">
                Soham Rajesh Pawar <br>
                Siddhant Sanjay Godbole <br>
                Aditya Abhaykumar Waghmare
            </div>
        </div>
       
    </footer>
</body>
<script>
    function logout() {
        
        sessionStorage.clear();
        window.location.href = 'login.php';
    }
    function addproject() {
        
        window.open('addproject.php', '_blank').unload = function() {window.location.reload();};
    }
    function changescreen(...args){
        
        document.getElementById('scrin').src="/WebDevProject/discription.php?name="+args;
        
    }
    function dele(...args){
        document.getElementById('scrin').src="/WebDevProject/delet.php?projectname="+args;  
    document.getElementById("usrname").innerHTML=args;

     window.location.reload();

    }
</script>


</html>