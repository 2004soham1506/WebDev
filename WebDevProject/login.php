<?php
session_start();
unset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/Logo.ico">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <img class="logo" src="Images\Logo.png">
        <br>
        <h1>Log In</h1>
        <form action="verifyuser.php" onsubmit="return validateForm()" method="post" name="loginForm">
            <div class="design" id="username">
                <label for="uname">User Name
                </label>
                <input type="text" name="uname" required placeholder="Enter Username" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="password">
                <label for="pw">Password
                </label>
                <input type="text" name="pw" required placeholder="Enter Password" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <input type="submit" class="button" value="Log In">
        </form>
    </div>
</body>
<script>
    function setError(id, error) {

        element = document.getElementById(id);
        element.querySelector('.formerror').innerHTML = error;
    }

    function clearErrors() {

        let errors = document.getElementsByClassName('formerror');
        for (let item of errors) {

            item.innerHTML = "";
        }
    }

    function validateForm() {

        clearErrors();
        let canreturn = true;
        let username = document.forms.loginForm.uname.value;
        let password = document.forms.loginForm.pw.value;

        let checkuser = /^[A-Za-z][A-Za-z0-9_]{7,29}$/;

        if (!checkuser.test(username.toLowerCase())) {

            setError("username", "*Username should start with an alphabet and can only have alphabets,numbers and an underscore. Also it should be 8-30 characters in length")
            canreturn = false;
        }

        let checkpass = /^[A-Za-z]\w{7,14}$/;

        if (!checkpass.test(password.toLowerCase())) {

            setError("password", "Password should start with an alphabet and can only have alphabets,numbers and an underscore. Also it should be 8-15 characters in length");
            canreturn = false;
        }
        if (password.length < 8 || password.length > 15) {

            setError("password", "*Password should be 8-15 characters long");
            canreturn = false;
        }
        return canreturn;
    }
</script>

</html>