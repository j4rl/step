<!DOCTYPE html>
<?php
    require_once('func.php');
    
    if(isset($_POST['btn'])){





        $user=$_POST['usr'];
        $real=$_POST['real'];
        $pass=md5($_POST['pwd']);
        $sql="INSERT INTO tbluser (username, password, name) VALUES ('$user', '$pass', '$real')";
        $result=$db->runQuery($sql);
        header("Location: index.php");
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrera användare</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<header><img src="Mockelngymnasiet-w400-svart-text-transparent.png" alt="Möckelngymnasiet">Registrera användare</header>
<main>
    <form autocomplete="false" method="post" action="adduser.php">
        <h1>Registrera användare</h1>
        <label for="usr">Användarnamn</label>
        <input type="text" name="usr" id="usr" placeholder="Användarnamn" required>
        <div id="usernameStatus"></div>
        <label for="real">För och efternamn</label>
        <input type="text" name="real" placeholder="Ditt namn" required>
        <label for="pwd">Lösenord</label>
        <input autocomplete="new-password" id="pwd" type="password" name="pwd" required pattern=".{8,}">
        <label for="vpwd"></label>
        <input autocomplete="new-password" id="vpwd" type="password" name="vpwd" required>
        <div id="passwordMatchStatus" class="password-mismatch">Lösenorden matchar inte</div>
        <input type="submit" value="Lägg till användare" name="btn" id="btn">
    </form>
</main>
<?php require_once("_footer.php") ?>
<script>
        $(document).ready(function() {
            $('#usr').on('input', function() {
                var username = $(this).val();

                // Make an AJAX request to check username availability
                $.post('check_username.php', { username: username }, function(response) {
                    $('#usernameStatus').html(response);
                });
            });
        });
    </script>
</body>
</html>

<script>
           // Function to check if passwords match
           function checkPasswordMatch() {
            const password1 = document.getElementById('pwd').value;
            const password2 = document.getElementById('vpwd').value;
            const matchStatus = document.getElementById('passwordMatchStatus');
            const submitButton = document.getElementById('btn');

            // Check if passwords match
            if (password1 === password2 && password1 !== '' && password2 !== '') {
                matchStatus.textContent = 'Lösenorden matchar';
                matchStatus.className = 'password-match';
                submitButton.removeAttribute('disabled');
            } else {
                matchStatus.textContent = 'Lösenorden matchar inte!';
                matchStatus.className = 'password-mismatch';
                submitButton.setAttribute('disabled', true);
            }
        }

        // Attach event listeners to both password input fields
        document.getElementById('pwd').addEventListener('input', checkPasswordMatch);
        document.getElementById('vpwd').addEventListener('input', checkPasswordMatch);

</script>