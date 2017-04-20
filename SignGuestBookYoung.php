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

            $DBName = "GuestBook";
            // Check to see if information was entered into the Guest Book form
            if(empty($_POST['first_name']) || empty($_POST['last_name'])) {
                echo "<p>You must enter your first and last name! Click your browser's Back button to " .
                        "return to the Guest Book form.</p>";
            } else {
                // Establish a connection to the MySQL Server
                $DBConnect = @mysql_connect("localhost", "root", "");
                if($DBConnect === false) {
                    echo "<p>Unable to connect to the database server.</p>" .
                        "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
                } else {
                    if( !@mysql_select_db($DBName, $DBConnect) ) {
                        $SQLstring = "CREATE DATABASE $DBName";
                        $QueryResult = @mysql_query($SQLstring, $DBConnect);
                        if($QueryResult === false) {
                            echo "<p>Error Code " . mysql_errno($DBConnect)
                        }
                    }
                }
            }
        ?>
    </div>
</div>
</body>
</html>