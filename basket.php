<?php
session_start(); // Start the session

include("db.php");

$pagename = "smart basket";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");

echo "<h4>".$pagename."</h4>";

// Check if the value of the product id to be deleted (which was posted through the hidden field) is set
if(isset($_POST['remove_id'])) {
    // Capture the posted product id and assign it to a local variable $delprodid
    $delprodid = $_POST['remove_id'];
    
    // Unset the cell of the session for this posted product id variable
    unset($_SESSION['basket'][$delprodid]);
    
    // Display a "1 item removed from the basket" message
    echo "<p>1 item removed from the basket";
}


// Check if the posted ID of the new product is set i.e. if the user is adding a new product into the basket
if(isset($_POST['h_prodid'])) {
    //capture the ID of selected product using the POST method and the $_POST superglobal variable 
    //and store it in a new local variable called $newprodid
    $newprodid = $_POST['h_prodid'];
    
    //capture the required quantity of selected product using the POST method and $_POST superglobal variable  
    //and store it in a new local variable called $reququantity
    $reququantity = $_POST['p_quantity'];
    
    //create a new cell in the basket session array. Index this cell with the new product id. 
    //Inside the cell store the required product quantity
    $_SESSION['basket'][$newprodid] = $reququantity; 
    
    //Display "1 item added to the basket " message
    echo "<p>1 item added to the basket";
} else {
    // Display "Basket unchanged" message
    echo "<p>Basket unchanged";
}

$total = 0; // Create a variable $total and initialize it to zero 

// Create a HTML table with a header to display the content of the shopping basket
echo "<form action='basket.php' method='post'>";
echo "<table border='1'>";
echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Remove Product</th></tr>";

// Check if the session array $_SESSION['basket'] is set
if(isset($_SESSION['basket'])) {
    // Loop through the basket session array for each data item inside the session using a foreach loop
    foreach($_SESSION['basket'] as $index => $value) {
        // SQL query to retrieve from Product table details of selected product for which id matches $index
        // Execute query and create array of records $arrayp (Assuming $index is the product ID)
        $query = "SELECT * FROM Product WHERE prodID=$index";
        $result = mysqli_query($conn, $query);
        $arrayp = mysqli_fetch_assoc($result);
        
        // Create a new HTML table row
        echo "<tr>";
        // Display product name
        echo "<td>".$arrayp['prodName']."</td>";
        // Display product price
        echo "<td>&pound;".$arrayp['prodPrice']."</td>";
        // Display selected quantity of product retrieved from the cell of session array and now in $value
        echo "<td>".$value."</td>";
        // Calculate subtotal, store it in a local variable $subtotal and display it
        $subtotal = $arrayp['prodPrice'] * $value;
        // Format subtotal as decimal with 2 decimal places
        echo "<td>&pound;".number_format($subtotal, 2)."</td>";
        // Increase total by adding the subtotal to the current total
        $total += $subtotal;
        // Add remove button
        echo "<td><input type='submit'
         name='remove' 
         value='Remove'
         style='width: 100px; padding: 8px; border: 2px; border-radius: 15px; background-color: black; color: white; cursor: pointer;'
         ></td>";

        
        // Use hidden field to post the product ID
        echo "<input type='hidden' name='remove_id' value='$index'>";
        echo "</tr>";
    }
    // Format total as decimal with 2 decimal places
    $formatted_total = number_format($total, 2);
    // Display total
    echo "<tr><td colspan='4'>Total</td><td>&pound;".$formatted_total."</td></tr>";
} else {
    // Display empty basket message
    echo "<br>Basket is empty";
    echo "<tr><td colspan='4'>Total</td><td>&pound;".number_format($total, 2)."</td></tr>";
}

echo "</table>";

echo "<br><br><a href='clearbasket.php'>Clear Basket</a>";
echo "<br><br>New homteq customers: ";
echo "<a href='signup.php'>Sign Up</a>";
echo "<br><br>Returning homteq customers: ";
echo "<a href='login.php'>Log In</a>";



include("footfile.html");
echo "</body>";
?>
