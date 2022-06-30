<?php

    session_start();
    session_destroy();  //すべてのセッションを削除

    header("Location:login.php");

?>