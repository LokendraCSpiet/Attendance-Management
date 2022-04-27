<?php

// mysql_connect('localhost','root','') or die('Cannot connect to server');
// mysql_select_db('attsystem') or die ('Cannot found database');


$con=mysqli_connect("localhost","root","","attsystem");
if(!$con)
{
    echo "unable to connect";
    die();
}

?>
