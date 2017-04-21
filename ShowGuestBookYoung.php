<!DOCTYPE html>
<html lang="en">
<head>
    <!--
       CSC 2410 Web Programming
       Chapter 8 Lab
       Part 1: Sign Guest Book

       Author: Brandon Young
       Date: 4/17/2017

       Filename: ShowGuestBookYoung.php
    -->
    <meta charset="UTF-8">
    <title>Guest Book Posts</title>
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
             * The ShowGuestBookYoung.php Script is used to display the names of people who have signed the
             * Guest Book. If nobody has signed the Guest Book yet than a message is displayed to the User.
             * Author: Brandon Young
             */

            // Open a connection to database
            $DBConnect = @mysql_connect("localhost", "root", "");
            // If connection to database doesn't work display an error
            if($DBConnect === false) {
                echo "<p>Unable to connect to the database server.</p>" .
                    "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
            } else {
                $DBName = "guestbook";
                // Check if the database is empty first and display message if it is
                if(!@mysql_select_db($DBName, $DBConnect)) {
                    echo "<p>There are no entries in the guest book!</p>";
                } else {
                    $TableName = "visitors";
                    // This query selects everything from the visitors table
                    $SQLstring = "SELECT * FROM $TableName";
                    $QueryResult = @mysql_query($SQLstring, $DBConnect);
                    // Output message if the visitors table is empty
                    if(mysql_num_rows($QueryResult) == 0) {
                        echo "<p>There are no entries in the guest book!</p>";
                    } else {
                        echo "<p>The following visitors have signed our guest book:</p>";
                        // This starts the beginning of a striped table
                        echo "<div class='col-xs-6'><table class='table table-striped'>";
                        // Add a head to the table
                        echo "<thead><tr><th>First Name</th><th>Last Name</th></tr></thead>";
                        echo "<tbody>";
                        // Loop through the query result and add each element to a new row in table
                        while(($Row = mysql_fetch_assoc($QueryResult)) !== false) {
                            echo "<tr><td>" . $Row['first_name'] . "</td>";
                            echo "<td>" . $Row['last_name'] . "</td></tr>";
                        } // end while
                        echo "</tbody></table>";
                        // Clear the query result
                        mysql_free_result($QueryResult);
                    } // end if else
                    // Close the database
                    mysql_close($DBConnect);
                } // end if else
            } // end if else
        ?>
    </div>
</div>
</body>
</html>