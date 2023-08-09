<!DOCTYPE html>
<html>
<head>
    <title>SmartScore</title>
</head>
<body>
    <h1>SmartScore</h1>
    
    <?php
    // Process uploaded image and perform test checking

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["uploaded_image"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploaded_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["uploaded_image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["uploaded_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["uploaded_image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["uploaded_image"]["name"])) . " has been uploaded.";

                // Perform test checking using image processing
                // Implement your image processing algorithm here
                // For example, you can use image processing libraries like OpenCV
/* mock databse gawa tau satin 
                // Store results in the database
                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "test_checker_db";

                // Create a database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert result into the database
                $result = "Pass"; // Replace with your test result
                $sql = "INSERT INTO test_results (image_name, result) VALUES ('" . $_FILES["uploaded_image"]["name"] . "', '$result')";

                if ($conn->query($sql) === TRUE) {
                    echo "Test result stored in the database.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close the database connection
 */
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="uploaded_image" id="uploaded_image">
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>
</html>
