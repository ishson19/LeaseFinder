<?php
    session_start();
    if (isset($_SESSION["userID"]) == false)
    {
        echo "Please login before viewing this page.";
        echo "<meta http-equiv=\"refresh\" content=\"2;url=login.html\">";
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    </head>

    <body>
    <?php
       // SESSION VARIABLE
                   $session=$_SESSION["userID"];
    ?>
        <div class="top" style="text-align:center">
            <form align="right" name="form1" method="post" action="main.php">
                    <label class="logoutLblPos">
                    <input name="profileBtn" type="submit" id="submit2" value="Main Page">
                    </label>
            </form>
            <form align="left" name="form1" method="post" action="log_out.php">
                <label class="mainLb1Pos">
                    <input name="submit2" type="submit" id="submit2" value="Logout">
                </label>
            </form>
            <?php
                    //load the table onto the html file by fetching from the database
                    $conn = new PDO("mysql:host=localhost;dbname=webdev",'root');
                    $entrystmt2=$conn->prepare("SELECT fname,lname,uname,contact FROM reguser INNER JOIN post
                        ON reguser.userid = post.userid AND reguser.userid = $session;");
                    $entrystmt2->execute();
                    $entries2=$entrystmt2->fetch();
                    //print_r($entries1);

                      $firstName = $entries2['fname'];
                      $lastName = $entries2['lname'];
                      print "<h1 style='color:whitesmoke'>Welcome $firstName $lastName!</h1>";
            ?>
        </div>
        <div id="welcome">
            <p>
                This is your profile page. You may look at all the apartments you have put up for renting/subleasing. If you have gotten\
 an offer you may delete your post.
            </p>
        </div>

        <div class="container" id="makePost">
            <p>
                <?php
                    //load the table onto the html file by fetching from the database
                    $entrystmt1=$conn->prepare("SELECT fname,lname,uname,contact FROM reguser INNER JOIN post
                        ON reguser.userid = post.userid AND reguser.userid = $session;");
                    $entrystmt1->execute();
                    $entries1=$entrystmt1->fetch();
                    //print_r($entries1);

                      $firstName = $entries1['fname'];
                      $lastName = $entries1['lname'];
                      $userName = $entries1['uname'];
                      $contact1= $entries1['contact'];
                      print "

 First Name: $firstName<br><br>
                      Last Name: $lastName<br><br>
                      Username: $userName<br><br>
                      Phone: $contact1";
                ?>
            </p>
        </div>

        <br>
        <br>

        <div id="posts">
            <!--a table of all the posts. One of the columns should be a "buy" button. If user logged in matches user who posted
                the post, the "buy" button will be replaced with a "remove" button.
                Row will look like:
                date posted, post name, description, contact info (phone and name), button

                If you think of something to add, please tell everyone else so that we can still get the button node for other
                functions.-->
            <form action="" method="post">
            <table id="postTable">
                <tr>
                    <th>Apartment</th>
                    <th>Description</th>
                    <th>Contact info</th>
                    <th>Delete Post No.:</th>
                </tr>
                <?php

                      if (isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem'])){
                      $delete= $_POST['deleteItem'];
                      $sql = "DELETE FROM post WHERE postid=$delete";
                      $conn->exec($sql);
                      }


                    //load the table onto the html file by fetching from the database
                    $entrystmt=$conn->prepare("SELECT postid,pname, description, contact FROM reguser INNER JOIN post
                    ON reguser.userid = post.userid AND reguser.userid = $session;");
                    $entrystmt->execute();
                    $entries=$entrystmt->fetchAll();

                    forEach($entries as $entry){
                      $postid = $entry['postid'];
                      $aptname = $entry['pname'];
                      $description = $entry['description'];
                      $phoneno = $entry['contact'];
                      print "<tr><td>$aptname</td><td>$description</td><td>$phoneno</td>";
                      echo '<td><input type="submit" name="deleteItem" value="'.$entry['postid'].'"/></td></tr>"';

}
?>




            </table>
            </form>
        </div>

    </body>
</html>

