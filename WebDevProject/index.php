<?php
session_start();
unset($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="images/Logo.ico">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container">
        <img class="logo" src="Images\Logo.png">
        <h1>Sign Up</h1>
        <form action="createuser.php" onsubmit="return validateForm()" method="post" name="signupForm">
            <div class="design" id="name">
                <label for="fname">Name
                </label>
                <input type="text" name="fname" required placeholder="Firstname Lastname" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="email">
                <label for="mail">Email
                </label>
                <input type="text" name="mail" required placeholder="Ex. abc@gmail.com" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="cinfo">
                <label for="info">Contact Info
                </label>
                <input type="text" name="info" required placeholder="9XXXXXXXXX" autocomplete="off"><b><span class="formerror"></span></b>
            </div>
            <div class="design" id="username">
                <label for="uname">User Name
                </label>
                <input type="text" name="uname" required placeholder="Ex. abc_123" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="password">
                <label for="pw">Password
                </label>
                <input type="text" name="pw" required placeholder="Enter Password" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="password2">
                <label for="cpw">Confirm Password
                </label>
                <input type="text" name="cpw" required placeholder="Confirm Password" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <input type="submit" class="button" value="Submit">
        </form>
        <div class="alreadyhave">
            Already have an account?<a href="login.php"> Log In</a>
        </div>
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
        let name = document.forms.signupForm.fname.value;
        let email = document.forms.signupForm.mail.value;
        let username = document.forms.signupForm.uname.value;
        let password = document.forms.signupForm.pw.value;
        let password2 = document.forms.signupForm.cpw.value;
        let cinfo = document.forms.signupForm.info.value;

        let chechname = /^[a-zA-Z]+ [a-zA-Z]+$/;

        if (!chechname.test(name.toLowerCase())) {

            setError("name", "*First name and Last name please");
            canreturn = false;
        }
        if (name.length < 5 || name.length > 50) {

            setError("name", "*Name length should be between 5 to 50 characters");
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
        if (password != password2) {

            setError("password2", "*Enter the same password as above");
            canreturn = false;
        }

        let checkuser = /^[A-Za-z][A-Za-z0-9_]{7,29}$/;

        if (!checkuser.test(username.toLowerCase())) {
            setError("username", "*Username should start with an alphabet and can only have alphabets,numbers and an underscore. Also it should be 8-30 characters in length");
            canreturn = false;
        }

        let checkmail = /^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/;

        if (!checkmail.test(email.toLowerCase())) {

            setError("email", "*Invalid email");
            canreturn = false;
        }

        let checkinfo = /^(\d{3})[- ]?(\d{3})[- ]?(\d{4})$/;

        if (!checkinfo.test(cinfo)) {

            setError("cinfo", "*Invalid contact info");
            canreturn = false;
        }
        return canreturn;
    }
</script>

</html>