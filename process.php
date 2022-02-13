<?php 

$mysqli = new mysqli('localhost', 'root', '', 'dbcrud') or die(mysqli_error($mysqli));
$update = false;
$id = 0;
$fname = '';
$lname = '';

//saving inputs
if (isset($_POST['save'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $mysqli->query("INSERT INTO data (FirstName, LastName) VALUES('$fname', '$lname') ") or die($mysqli->error());

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
}


//delete 
if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
} 

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    if (count($result)==1){
        $row = $result->fetch_array();
        $fname = $row['fname'];
        $lname = $row['lname'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $mysqli->query("UPDATE data SET fname='$fname', lname='$lname' WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}