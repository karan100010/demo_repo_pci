<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Upload files to the "upload" folder in the root path
    $uploadFolder = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder);
    }

    // Move uploaded files to the upload folder
    $fileNames = [];
    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['files']['name'][$key];
        $destination = $uploadFolder . $fileName;
        move_uploaded_file($tmpName, $destination);
        $fileNames[] = $fileName;
    }

    // Store the file names in $_POST["files"]["name"]
    $_POST["files"]["name"] = $fileNames;

    // Print the components of the POST request
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    //rediret to the upload_file.php
    header("Location: upload_files.php");
}
?>