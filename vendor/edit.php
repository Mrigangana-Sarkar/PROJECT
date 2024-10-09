<?php
$conn=new mysqli("localhost","root","","acme24_jul",3306);
include "../shared/connection.php";

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Fetch product details based on pid
    $sql = "SELECT * FROM product WHERE pid = $pid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $owner = $_POST['owner'];
    $impath = $row['impath']; // Start with the current image path

    // Check if a new file has been uploaded
    if (!empty($_FILES['new_image']['name'])) {
        $target_dir ="../shared/images/"; // directory where images will be saved
        $target_file = $target_dir . basename($_FILES['new_image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($_FILES['new_image']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
                $impath = $target_file; // update the image path to the new file
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update query
    $sql = "UPDATE product SET name='$name', price='$price', detail='$detail', impath='$impath', owner='$owner' WHERE pid=$pid";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
        header("location:view.php");
    } else {
        echo "Error updating product: " . $conn->error;
        header("location:view.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
        
        <label for="price">Price:</label>
        <input type="text" name="price" value="<?php echo $row['price']; ?>"><br><br>
        
        <label for="detail">Detail:</label>
        <textarea name="detail"><?php echo $row['detail']; ?></textarea><br><br>
        
        <label for="current_image">Current Image URL:</label>
        <input type="text" name="current_image" value="<?php echo $row['impath']; ?>" readonly><br><br>
        
        <label for="new_image">New Image:</label>
        <input type="file" name="new_image"><br><br>
        
        <label for="owner">Owner:</label>
        <input type="text" name="owner" value="<?php echo $row['owner']; ?>"><br><br>
        
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

