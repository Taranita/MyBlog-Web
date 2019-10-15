<?php


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "cymant0na");
define("DB_NAME", "myblog_db");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$con)
{
    echo "ERROR! " . mysqli_connect_error();
}