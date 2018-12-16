<?php
        // get the connection.
        $conn = new PDO("mysql:host=localhost;dbname=webdev",'root');
        $uname = $_POST['email'];
        $formPassword = $_POST['password'];

        // SQL statement
        $getPasswordStmt = $conn->prepare("Select pwd from reguser where uname='".$uname."'");
        $getPasswordStmt->execute();
        $passwords = $getPasswordStmt->fetch();
        $securePassword = $passwords['pwd'];
        $newPassword = md5($formPassword);

        // compare passwords
        if ($securePassword == md5($formPassword)) {
           // start the session
           session_start();
           $getUID = $conn->prepare("Select userid from reguser where uname='".$uname."'");
           $getUID->execute();
           $UID = $getUID->fetch();
           $UID = $UID[0];

           // set the session variable
           $_SESSION["userID"] = $UID;
           $_SESSION["test"] = "This is a test.";
          /* $message = "Session is $_SESSION[\"userID\"]. UID is $UID";
           echo "<script type='text/javascript'>
                        alert('$message');</script>";
        */
        echo "<meta http-equiv=\"refresh\" content=\"0;url=main.php\">";
        } //if
        else {
           echo "Incorrect Password. Redirecting you back to login page.";
           echo "<meta http-equiv=\"refresh\" content=\"2;url=login.html\">";
        } //else
?>