<!DOCTYPE html>
<html lang="en">
<head>
    <!--
       CSC 2410 Web Programming
       Chapter 8 Lab
       Part 1: Sign Guest Book

       Author: Brandon Young
       Date: 4/17/2017

       Filename: SignGuestBookYoung.php
    -->
    <meta charset="UTF-8">
    <title>Guest Book</title>
    <!-- Latest compiled and mninified JQuery for Bootstrap to work -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Lab 8</h1>
    </div>
    <div class="row">
        <?php

            /**
             *
             * Author: Brandon Young
             */
            // Open database connection
            $connect = mysqli_connect("localhost", "root", "rootpw");

            echo "<p>MySQL client version: " . mysqli_get_client_info() . "</p>\n";

            if($connect === false) {
                echo "<p>Connection failed.</p>\n";
            } else {
                echo "<p>MySQL connection: " . mysqli_get_host_info($connect) . "</p>\n";
                echo "<p>MySQL Protocol Version: " . mysqli_get_proto_info($connect). "</p>\n";
                echo "<p>MySQL Server Version: " . mysqli_get_server_info($connect) . "</p>\n";
            } // end if else

            $databaseName = "premiere";
            $dbResult = @mysqli_select_db($databaseName, $connect);

            if($dbResult === false) {
                echo "<p>Unable to select the database.</p><p>Error code " . mysqli_errno($connect) . ": " . mysqli_error($connect) . "</p>";

            } else {
                echo "<p>Successfully opened the database.</p>";
                $SQLstring = "SELECT CUSTOMER_NAME FROM CUSTOMER";
                if(mysqli_num_rows(mysqli_query($connect, $SQLstring))) {
                    for($i = 0; i < mysqli_num_rows(mysqli_query($connect, $SQLstring)); $i++) {
                        echo mysqli_result($QUERYResult, $i);
                    } // end foreach
                } // end if
            } // end if else

            // close the database connection
            mysqli_close($connect);
        ?>
    </div>
</div>
</body>
</html>