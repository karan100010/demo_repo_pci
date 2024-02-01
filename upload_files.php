<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
</head>
<body>
    <h1>Upload Files</h1>

    <!-- Form for uploading files -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select files to upload:</label><br>
        <input type="file" id="file" name="files[]" multiple><br>
        <input type="submit" value="Upload" name="submit">
    </form>

    <hr>

    <h2>Uploaded Files List</h2>
    <ul>
        <?php
        // Directory where uploaded files are stored
        $uploadDirectory = "uploads/";

        // Check if the directory exists
        if (is_dir($uploadDirectory)) {
            // Get all files in the directory
            $files = scandir($uploadDirectory);

            // Remove "." and ".." entries
            $files = array_diff($files, array('.', '..'));

            // Loop through each file and create a link for downloading
            foreach ($files as $file) {
                echo "<li><a href='$uploadDirectory$file' download>$file</a></li>";
            }
        } else {
            echo "<p>No uploaded files found.</p>";
        }
        ?>
    </ul>
</body>
</html>
