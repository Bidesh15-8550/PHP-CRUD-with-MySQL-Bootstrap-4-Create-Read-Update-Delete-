<?php

session_start();

$id=0;
$mysqli = new mysqli ('localhost','root','','crud') or die(mysqli_error($mysqli)); //connecting to database
$name = '';
$location = '';
$update = false;

//inserting database

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];


    $mysqli->query("INSERT INTO data (name, location) VALUES('$name','$location')") or
    die($mysqli->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php"); //redirects to the page after the operation
}

//delete

if(isset($_GET['delete'])){
    $id = $_GET["delete"];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die ($mysqli->error());

    
    $_SESSION['message'] = "Record has been deleted!";   
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}

//edit

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die ($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

//update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die ($mysqli->error());
    $_SESSION['message'] = "Record has been updated!";   
    $_SESSION['msg_type'] = "warning";
    header("location: index.php");
}



?>