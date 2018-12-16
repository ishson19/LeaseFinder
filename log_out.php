<?php
    // resume the session
    session_start();
    // delete the session that we got access to
    session_destroy();

    // redirect back to login page.
    echo "Session ended. Redirecting back to login.";
    echo "<meta http-equiv=\"refresh\" content=\"2;url=login.html\">";
?>
