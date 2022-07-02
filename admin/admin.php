<?php
session_start();

if (!isset($_SESSION["status"])) {
    header("location: auth.html");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/loading.css">
</head>

<body>
    <div id="loading" style="display:flex">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>

    <div class="navbar">
        <div class="label"><span class="admin-text">Admin</span>Records</div>
        <div class="logout">
            <a href="../php/logOut.php" class="logout">Log Out</a>
        </div>
    </div>

    <div class="table">
        <div class="table-head">
            <div class="number">#</div>
            <div class="name">Name</div>
            <div class="email">Email</div>
            <div class="date">Date</div>
        </div>

        <div class="rows">
            <!--<div class="table-row">
            <div class="number">1</div>
            <div class="name">Theophilus</div>
            <div class="email">theophilito@gmail.com</div>
            <div class="date">12/43/54</div>
        </div>

        <div class="table-row">
            <div class="number">1</div>
            <div class="name">Theophilus</div>
            <div class="email">theophilito@gmail.com</div>
            <div class="date">12/43/54</div>
        </div>
        <div class="table-row">
            <div class="number">1</div>
            <div class="name">Theophilus</div>
            <div class="email">theophilito@gmail.com</div>
            <div class="date">12/43/54</div>
        </div>-->

            <div class="table-row-mobile">
                <p>#: 1</p>
                <p>Name: Theophilus Addo</p>
                <p>Email: theophilito@gmail.com</p>
                <p>Date: 10/423/4</p>
            </div>
        </div>

    </div>

    <script src="../js/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            //Fetch Featured Products;
            function fetchUsers() {
                var screen_width = $(window).width();
                $.ajax({
                    type: "GET",
                    url: "../php/backend.php?fetch_data=true&width=" + screen_width,
                    dataType: "text",
                    success: function(data) {
                        document.getElementById("loading").style.display = "none";
                        if (data != "none") {
                            $('.rows').html(data);
                        } else {
                            document.getElementById("no-favorites").style.display = "flex";
                        }
                    },
                    complete: function(data) {
                        setTimeout(fetchUsers, 1000);
                    }
                })
            }

            setTimeout(fetchUsers, 200);

        });
    </script>

</body>

</html>