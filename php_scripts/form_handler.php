<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $category = $_POST["category"];

    // File upload handling
    if (isset($_FILES["image"])) {
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_type = $_FILES["image"]["type"];

        // Specify the directory to save the uploaded file
        $upload_directory = "uploads/";
        
        // You may want to add additional checks here, like file size, file type, etc.

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            // File upload successful
        } else {
            // File upload failed
        }
    }

    // Now you can process the form data as per your requirements
    // For example, you can store the form data in a database, send an email, etc.

    // Database connection configuration
    $db_host = "localhost"; // Typically "localhost" if your database is on the same server as your PHP script
    $db_user = "root";
    $db_pass = "";
    $db_name = "chandrayaan4"; // Replace with your actual database name
    // (Place your code here to handle the form data)

    // Create a new database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to insert data into the table
    $sql = "INSERT INTO contact_forms (name, dob, contact, address, category, image) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssss", $name, $dob, $contact, $address, $category, $file_name); // "ssssss" represents the data types of the parameters

    // Execute the statement
    if ($stmt->execute()) {
        // Data insertion successful
        // You can add any success message or redirect the user to another page if needed
    } else {
        // Data insertion failed
        // You can add an error message or handle the error as needed
    }


    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

}
?>
