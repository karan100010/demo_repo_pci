<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Gallery</title>
</head>
<body>
    <h1>Document Gallery</h1>
    <ul>
        <?php
        // Directory where your documents are stored
        $documentDirectory = "documents/";

        // Get all files in the directory
        $files = scandir($documentDirectory);

        // Remove "." and ".." entries
        $files = array_diff($files, array('.', '..'));

        // Loop through each file and create a link for downloading
        foreach ($files as $file) {
            echo "<li><a href='$documentDirectory$file' download>$file</a></li>";
        }
        ?>
    </ul>
</body>
</html>
