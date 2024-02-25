<?php
$pagename="sign up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="signup_process.php" method="post">
        <table>
            <tr>
                <td><label for="firstName">First Name:</label></td>
                <td><input type="text" id="firstName" name="firstName" ></td>
            </tr>
            <tr>
                <td><label for="lastName">Last Name:</label></td>
                <td><input type="text" id="lastName" name="lastName" ></td>
            </tr>
            <tr>
                <td><label for="address">Address:</label></td>
                <td><input type="text" id="address" name="address" ></td>
            </tr>
            <tr>
                <td><label for="postcode">Postcode:</label></td>
                <td><input type="text" id="postcode" name="postcode"></td>
            </tr>
            <tr>
                <td><label for="email">Email Address:</label></td>
                <td><input type="text" id="email" name="email" ></td>
            </tr>
            <tr>
                <td><label for="phone">Tel No:</label></td>
                <td><input type="text" id="phone" name="phone" ></td>
            </tr>
            
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" ></td>
            </tr>
            <tr>
                <td><label for="password">Confirm password:</label></td>
                <td><input type="password" id="confirm_password" name="confirm_password" ></td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="submit" value="Sign Up" style='width: 100px; padding: 8px; border: 2px; border-radius: 15px; background-color: black; color: white; cursor: pointer;'>
                    <input type="reset" value="Clear form" style='width: 100px; padding: 8px; border: 2px; border-radius: 15px; background-color: black; color: white; cursor: pointer;'>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>



<?php
include("footfile.html"); //include head layout
echo "</body>";
?>