<?php

    $db_server = "walrus-app-qf4im.ondigitalocean.app";
    $db_user = "root";
    $db_pass = "";
    $db_name = "users";
    $connect = "";

    try{
        $connect = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }catch(mysqli_sql_exception $e){
        echo "Something went wrong";
    }catch(TypeError $e){
        echo "Something went wrong";
    }




?>
