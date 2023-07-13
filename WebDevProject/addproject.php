<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kollabor8 - Project Creation</title>
    <link rel="icon" type="image/x-icon" href="images/Logo.ico">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="addproject.css">
</head>

<body>
    <div class="container">
        <img class="logo" src="Images\Logo.png">
        <br>
        <h1>Create Your Project</h1>
        <form action="createproject.php" onsubmit="return validateForm()" method="post" name="projectForm">
            <div class="design" id="projectname">
                <label for="name">Project Name
                </label>
                <input type="text" name="name" required placeholder="Ex. Web Development Project" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <div class="design" id="description">
                <label for="des">Project Description
                </label>
                <textarea id="des" name="des" rows="4" cols="43" required placeholder="Brief discription of the project"></textarea>
           <b><span class="formerror"></span></b>
            </div>
            <div class="design" id="whatsapplink">
                <label for="link">WhatsApp Link
                </label>
                <input type="text" name="link" required
                    placeholder="Ex. https://chat.whatsapp.com/DOPpVwG9Cb5Jb8LjdWBf9K" autocomplete="off"><b><span
                        class="formerror"></span></b>
            </div>
            <input type="submit" class="button" value="Submit">
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
        let name = document.forms.projectForm.name.value;
        let description = document.forms.projectForm.des.value;
        let link = document.forms.projectForm.link.value;

        let chechname = /^(\w+\s*){1,3}$/;

        if (!chechname.test(name.toLowerCase())) {

            setError("projectname", "*Name should have 1-3 words composed of letters and/or numbers");
            canreturn = false;
        }
        if (name.length < 5 || name.length > 50) {

            setError("projectname", "*Name length should be between 5 to 50 characters");
            canreturn = false;
        }

        let checkdes = /^[A-Za-z0-9,.':\s]+$/;

        if (!checkdes.test(description.toLowerCase())) {

            setError("description", "*Description can be alphanumeric only");
            canreturn = false;
        }
        if (description.length > 5000) {

            setError("description", "Description can't be more that 5000 characters in length");
            canreturn = false;
        }

        let checklink = /^(https?:\/\/)?chat\.whatsapp\.com\/(?:invite\/)?([a-zA-Z0-9_-]{22})$/;

        if (!checklink.test(link.toLowerCase())) {

            setError("whatsapplink", "*Invalid link");
            canreturn = false;
        }
        return canreturn;
    }
</script>

</html>