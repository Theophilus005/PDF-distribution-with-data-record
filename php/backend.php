<?php
require_once "databaseConnection.php";
session_start();

if(isset($_GET["name"]) && isset($_GET["email"])) {
    $name = $_GET["name"];
    $email = $_GET["email"];
    $date = date("d/m/Y h:i a");

    $insert = "INSERT INTO users(name, email, date) VALUES('$name', '$email', '$date')";
    if($conn->query($insert)) {
        echo "success";
    } 
}

if(isset($_GET["pin"])) {
    $pin = $_GET["pin"];

    //Check
    $check = "SELECT * FROM pins WHERE pin = $pin";
    $check_result = $conn->query($check);
    if($check_result->num_rows > 0) {
        $_SESSION["status"] = "ok";
        echo "success";
    } else {
        echo "error";
    }


}


if(isset($_GET["fetch_data"])) {
    $id = array();
    $name = array();
    $email = array();
    $date = array();

    $screen = $_GET["width"];

    $fetch = "SELECT * FROM users";
    $fetch_result = $conn->query($fetch);
    if($fetch_result->num_rows > 0) {
        while($users=$fetch_result->fetch_assoc()) {
        $id[] = $users["id"];
        $name[] = $users["name"];
        $email[] = $users["email"];
        $date[] = $users["date"];
        }
    }

    if($screen > 760) {
    for($i=0; $i<count($id); $i++) {
        echo <<<TABLEROW
        <div class="table-row">
        <div class="number">{$id[$i]}</div>
        <div class="name">{$name[$i]}</div>
        <div class="email">{$email[$i]}</div>
        <div class="date">{$date[$i]}</div>
    </div>
TABLEROW;
    }
} else {
    for($i=0; $i<count($id); $i++) {
    echo <<< TABLEROWMOBILE
    <div class="table-row-mobile">
    <p>#: {$id[$i]}</p>
    <p>Name: {$name[$i]}</p>
    <p>Email: {$email[$i]}</p>
    <p>Date: {$date[$i]}</p>
</div>
TABLEROWMOBILE;
    }
}
}



?>