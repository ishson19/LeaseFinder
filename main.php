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
        <script>

        </script>
    </head>

    <body>
       <?php
       // THIS IS TO TEST THE SESSION VARIABLE
        $session=$_SESSION["userID"];
        //print "is set? " . isset($_SESSION["userID"]);
                /*print "session variable is: ";
                print $session;
                print "\n test variable is: ";
                print $_SESSION["test"];*/

         // from here on, it's the html skeleton that calls other functionalities... except the table.
            ?>
         <div class="top" style="text-align:center">
            <form align="right" name="form1" method="post" action="profile.php">
                    <label class="logoutLblPos">
                    <input name="profileBtn" type="submit" id="submit2" value="Profile">
                    </label>
            </form>
            <form align="left" name="form1" method="post" action="log_out.php">
                <label class="profileLb1Pos">
                    <input name="submit2" type="submit" id="submit2" value="Logout">
                </label>
            </form>

            <h1 style="color:whitesmoke">LeaseFinder!</h1>

        </div>
        <div id="welcome">
            <p>
                Welcome to this wonderous renting page! Please feel free to make posts and browse our wonderous selection!
            </p>
       </div>


        <div class="container" id="makePost">
            <!-- maybe it could look sort of like facebook's post making thing?-->
            <form id="makePostForm" method="post" action="insert.php">
                Apartment:<br>
                <input type="text" id="postNameInput" name="aptname"><br>
                Description:<br>
                <input type="text" id="postDescInput" name="description"><br>
                <!--I don't know if to make an input for contact info
                    because it should be part of their user info-->
                <input type="submit" value="Submit"><br><br>
            </form>
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
            <table id="postTable">
                <tr>
                    <th>Seller</th>
                    <th>Apartment</th>
                    <th>Description</th>
                    <th>Contact info</th>
                </tr>
                <?php
                    // to make a dynamic table. Get the PDO connection, and make the sql statement
                    $conn1 = new PDO("mysql:host=localhost;dbname=webdev",'root');
                    $rawTable = $conn1->prepare("SELECT fname,lname,contact,pname,description
                        FROM reguser INNER JOIN post
                        ON reguser.userid = post.userid;");
                    $rawTable->execute();
                    $table = $rawTable->fetchAll();
                    foreach($table as $row){
                        //print_r($row);
                        //print "<br>";
                        echo "<tr><td>" . $row["fname"]. " " .
                        $row["lname"] ."</td><td>" .
                        $row["pname"]. "</td><td>" .
                        $row["description"]. "</td><td>" . "Phone: " .
                        $row["contact"] ."</td></tr>";

                        /*print "<tr>";
                            print "<td>$row[\"name\"]</td>";
                            print "<td>$row[\"time\"]</td>";
                            print "<td>$row[\"entry\"]</td>";
                        print "</tr>";*/
                    }
                ?>
            </table>
            <?php

            ?>
        </div>

        <br><br>
        <div style="text-align:center" class="container" id="contactUs">
            <!--At the bottom of a lot of pages, there's a "contact us" little area. We could do something like that?-->
            <h2>Contact Us!</h2>
            <p>Phone: 123-123-1234; Email:amazingAdmins@sample.com</p>
        </div>
    </body>
</html>
