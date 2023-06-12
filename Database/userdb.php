<?php

    $db_server = "localhost";
    $db_user = "sammy";
    $db_pass = "Qa061103#";
    $db_name = "users";
    $connect = "";


    try{
        $connect = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }catch(mysqli_sql_exception){
        echo "Something went wrong";
    }catch(TypeError){
        echo "Something went wrong";
    }
