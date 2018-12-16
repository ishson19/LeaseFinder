     <?php
        session_start();
           $dbhost = '172.17.149.81';
                 $dbuser = 'hima';
                 $dbpass = 'password';
                 $conn = new PDO('mysql:host=localhost;dbname=webdev','root') or die('Could not connect:'.mysqli_error());
            // Check connection

          if(isset($_POST['aptname']) && isset($_POST['description']) ){
                  if(!empty($_POST['aptname']) && !empty($_POST['description']) ){

                         //checks if the row exists with the user inputted username and password
                         $sql = $conn -> prepare("SELECT userid FROM reguser WHERE userid=:uname1");
                         $sql -> bindValue('uname1', $_SESSION["userID"]);
                         //$sql -> bindValue('description1',  $_POST['description'] );
                         $sql -> execute();

                            $result = $sql -> fetchAll();
                         $count = $sql->rowCount(); //counts the number of rows with the corresponding username and password
                          // If result matched $username and $password, table row must be 1 row. Then entry is inserted into database
                          if ($count==1 ) {

                              $addEntry = $conn -> prepare("Insert into post(pname, description, userid) values(:pname1, :description1, \
:userid1)");
                              $addEntry -> bindValue('pname1', $_POST['aptname'] );
                              $addEntry -> bindValue('description1', $_POST['description'] );
                              $addEntry -> bindValue('userid1', $_SESSION["userID"] );
                              $addEntry -> execute();
                              $addEntry -> closeCursor();

                                echo "<meta http-equiv=\"refresh\" content=\"0;url=main.php\">";
                          } else {
                              echo "Incorrect username";
                          }
                    }
                    else{
                        if (empty($_POST['aptname'])) {
                         echo "Apartment name not selected" ;
                         echo "<br>";
                        }
                        if (empty($_POST['description'])) {
                           echo "Description is blank" . "\r\n";
                           echo "<br>";
                        }

                  }
            }



         ?>
