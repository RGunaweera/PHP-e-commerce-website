<?php
session_start();
include("db.php");
mysqli_report(MYSQLI_REPORT_OFF); 


$pagename = "Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 7 inputs entered in the 7 fields of the form using the $_POST superglobal variable 
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//if the mandatory fields in the form (all fields) are not empty
if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($phone) && !empty($address) && !empty($password) && !empty($confirm_password))
{ 
    //if the 2 entered passwords do not match 
    if ($password != $confirm_password)
    { 
        //Display error passwords not matching message 
        echo "<b>Your signup failed!</b><br><br>";
        echo "The 2 passwords are not matching.<br>";
        //Display a link back to register page  
        echo "<br>Go back to: ";
        echo "<a href='signup.php'>Sign Up</a>";
    } 
    else 
    { 
        //define regular expression  
        $regEmail = "/^([a-zA-Z0-9]+)@([a-zA-Z0-9]+)\.([a-zA-Z]{2,5})$/";
        //if email matches the regular expression      (hint: use preg_match) 
        if (preg_match($regEmail, $email))
        { 
            //Write SQL query to insert a new user into users table and execute SQL query 
            $sql = "INSERT INTO users (userFName, userSName, userEmail, userTelNo, userAddress, userPostCode, userPassword) 
                    VALUES ('$firstName', '$lastName', '$email', '$phone', '$address', '$postcode', '$password')";
            
            // Execute the INSERT INTO SQL query
            if (mysqli_query($conn, $sql)) 
            { 
                //Display signup confirmation message 
                echo "User registration successful!<br>";
                //Display a link to login page 
                echo "<br>Proceed to: ";
                echo "<a href='login.php'>Login</a>";
            } 
            else 
            { 
                //Display generic error message 
                echo "Error: " . mysqli_error($conn);
                //Return the SQL execution error number using the error detector (hint: use mysqli_errno($conn)) 
                //if error detector returns number 1062 i.e. unique constraint on the email is breached  
                //(meaning that the user entered an email which already existed) 
                if (mysqli_errno($conn) == 1062)
                { 
                    //Display email already taken error message & display a link back to signup page 
                    echo "<b>Your signup failed!</b><br>";
                    echo "<br>An account with the email address you provided already exists.<br>";
                    echo "<br>Go back to: ";
                    echo "<a href='signup.php'>Sign Up</a>";
                } 
                //if error detector returns number 1064 i.e. invalid characters such as ' and \ have been entered  
                else if (mysqli_errno($conn) == 1064)
                { 
                    //Display invalid characters error message & display a link back to signup page 
                    echo "<b>Your signup failed!</b><br>";
                    echo "<br><br>Invalid characters used.<br>";
                    echo "<br>Go back to: ";
                    echo "<a href='signup.php'>Sign Up</a>";
                } 
            } 
        } 
        //else 
        else 
        { 
            //Display "email not in the right format" message and link back to signup page 
            echo "<b>Your signup failed!</b><br>";
            echo "<br>Please enter your email address correctly.<br>";
            echo "<br>Go back to: ";
            echo "<a href='signup.php'>Sign Up</a>";
        } 
    }  
} 
else 
{ 
    echo "<b>Your signup failed!</b><br><br>";
    echo "All mandatory fields need to be filled in.<br>";
    echo "<br>Go back to: ";
    echo "<a href='signup.php'>Sign Up</a>";
} 

include("footfile.html"); //include head layout
echo "</body>";
?>
