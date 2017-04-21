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
    <title>Sign Guest Book</title>
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

    <div class="row">
        <?php
            /**
             * The SignGuestBookYoung.php script is used to handle the form in GuestBookYoung.html.
             * This page connects to the MySQL Database and
             * Author: Brandon Young
             */

            // Check to see if information was entered into the Guest Book form
            if(empty($_POST['first_name']) || empty($_POST['last_name'])) {
                echo "<p>You must enter your first and last name! Click your browser's Back button to " .
                        "return to the Guest Book form.</p>";
            } else {
                // Establish a connection to the MySQL Server
                $DBConnect = @mysql_connect("localhost", "root", "");
                // Check if the connection to Database worked and if not display an error message
                if($DBConnect === false) {
                    echo "<p>Unable to connect to the database server.</p>" .
                        "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
                } else {
                    $DBName = "guestbook";
                    // If database does not exist than create it
                    if( !@mysql_select_db($DBName, $DBConnect) ) {
                        $SQLstring = "CREATE DATABASE $DBName";
                        $QueryResult = @mysql_query($SQLstring, $DBConnect);
                        // Output error if creating the table doesn't work
                        if($QueryResult === false) {
                            echo "<p>Unable to execute the query.</p>" .
                                "<p>Error Code " . mysql_errno($DBConnect) . ": " . mysql_error($DBConnect) . "</p>";
                        } else {
                            // Output message to first person to sign the guest book
                            echo "<p>You are the first visitor!</p>";
                        } // end if else
                        mysql_select_db($DBName, $DBConnect);
                    } // end if
                } // end if else

                // TableName holds the name of the table to be used
                $TableName = "visitors";
                // This SQL Query looks for a table named visitors
                $SQLstring = "SHOW TABLES LIKE '$TableName'";
                $QueryResult = @mysql_query($SQLstring, $DBConnect);
                // If the table does not exist this creates the visitors table
                if(mysql_num_rows($QueryResult) == 0) {
                    $SQLstring = "CREATE TABLE $TableName 
                (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                last_name VARCHAR(40), first_name VARCHAR(40))";
                    $QueryResult = @mysql_query($SQLstring, $DBConnect);
                    // Display error message if creating the visitor table fails
                    if($QueryResult === false) {
                        echo "<p>Unable to create the table.</p>"
                            . "<p>Error code " . mysql_errno($DBConnect)
                            . ": " . mysql_error($DBConnect) . "</p>";
                    } // end if
                    // Collect the information that was submitted in the form
                    $LastName = stripslashes($_POST['last_name']);
                    $FirstName = stripslashes($_POST['first_name']);
                    // This SQL Query will add the form information to the visitor table
                    $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";
                    $QueryResult = @mysql_query($SQLstring, $DBConnect);
                    // If the query doesn't work display an error
                    if($QueryResult === false) {
                        echo "<p>Unable to create the table.</p>"
                            . "<p>Error code " . mysql_errno($DBConnect)
                            . ": " . mysql_error($DBConnect) . "</p>";
                    } else {
                        echo "<h1>Thank you for signing our guest book!</h1>";
                    } // end if else
                    // Close the connection to the database
                    mysql_close($DBConnect);
                } // end if
            } // end if else
        ?>
    </div><!-- .row -->
</div><!-- .container -->
</body>
</html>