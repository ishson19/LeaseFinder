<?php
    // connecting to PDO, if it's not localhost
    //$dns = "mysql:host=172.17.149.81;dbname=webdev";
   //$conn = new PDO("mysql:host=localhost;dbname=webdev",'root');

   //$conn = new PDO($dns,"anna","password");
   $conn = new PDO("mysql:host=localhost;dbname=webdev",'root');

    // bind values and insert them.
   $addUserStmt = $conn->prepare("Insert into reguser (uname, pwd, contact, fname, lname) values (:uname, :pwd, :contact, :fname, :lname\
)");
   $uname = $_POST["email"];
   $addUserStmt->bindValue(':uname', $uname);
   $pwd = $_POST["password"];
   $addUserStmt->bindValue(':pwd', md5($pwd));
   $contact = $_POST["contact"];
   $addUserStmt->bindValue(':contact', $contact);
   $fname = $_POST["first-name"];
   $addUserStmt->bindValue(':fname', $fname);
   $lname = $_POST["last-name"];
   $addUserStmt->bindValue(':lname', $lname);
   $addUserStmt->execute();
   $addUserStmt->closeCursor();
   echo "<meta http-equiv=\"refresh\" content=\"0;url=login.html\">";
?>

