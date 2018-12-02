<?php
        $conn = new PDO("mysql:host=localhost;dbname=webdev",'root');
        $uname = $_POST["email"];
        $formPassword = $_POST["password"];
        $getPasswordStmt = $conn->prepare("Select pwd from reguser where uname='".$uname."'");
        $getPasswordStmt->execute();
        $passwords = $getPasswordStmt->fetch();
        $securePassword = $passwords['pwd'];
        $newPassword = md5($formPassword);
        if ($securePassword == md5($formPassword)) {
           echo "<meta http-equiv=\"refresh\" content=\"0;url=main.html\">";
        } //if
        else {
           echo "Incorrect Password. Redirecting you back to login page.";
           echo "<meta http-equiv=\"refresh\" content=\"2;url=login.html\">";
        } //else
?>
