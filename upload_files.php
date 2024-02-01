<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .form-group {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-control-file {
            display: block;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        hr {
            margin-top: 40px;
            margin-bottom: 40px;
            border: 0;
            border-top: 1px solid #ddd;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .list-group-item {
            text-align: center;
        }

        .list-group-item a {
            color: #333;
            text-decoration: none;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Upload Files</h1>

        <!-- Form for uploading files -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group text-center">
                <label for="file">Select files to upload:</label>
                <input  type="file" id="file" name="files[]" multiple class="form-control-file text-center">
            </div>
            <div class="text-center">
                <input type="submit" value="Upload" name="submit" class="btn btn-primary">
            </div>
        </form>

        <hr>

        <h2 class="text-center">Uploaded Files List</h2>
        <ul class="list-group">
            <?php
            // Directory where uploaded files are stored
            $uploadDirectory = "upload/";

            // Check if the directory exists
            if (is_dir($uploadDirectory)) {
                // Get all files in the directory
                $files = scandir($uploadDirectory);

                // Remove "." and ".." entries
                $files = array_diff($files, array('.', '..'));

                // Loop through each file and create a link for downloading
                foreach ($files as $file) {
                    echo "<li class='list-group-item text-center'><a href='$uploadDirectory$file' download>$file</a></li>";
                }
            } else {
                echo "<p class='text-center'>No uploaded files found.</p>";
            }
            ?>
        </ul>
    </div>

    <script src="jquery-3.3.1.slim.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>
