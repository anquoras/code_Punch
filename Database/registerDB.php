<?php

    $db_server = "EHCTeam11";
    $db_user = "admin";
    $db_pass = "7ec7dab4023ede2b34f2445e61b8b47e6ce492c945525daf";
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
