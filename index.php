<?php
// Start the session
session_start();

// Record the starting time
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Record device information
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $user_agent;
}

// Record the button clicks
if (!isset($_SESSION['button_clicks'])) {
    $_SESSION['button_clicks'] = array();
}

if (isset($_GET['button'])) {
    $button = $_GET['button'];
    $_SESSION['button_clicks'][] = $button;

    // Write the session details to a CSV file
    $session_id = session_id();
    $session_length = time() - $_SESSION['start_time'];
    $csv_data = array($session_id, $user_agent, $session_length, $button);
    $fp = fopen('session_data.csv', 'a');
    if (!$fp) {
        echo "Error opening file"; // or use die() function to stop execution
    }
    if (!fputcsv($fp, $csv_data)) {
        echo "Error writing to file"; // or use die() function to stop execution
    }
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gramrite</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- External CSS file -->
    <link rel="stylesheet" href="styles.css">

    <!-- External JS files -->
    <script src="jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>

<body>

    <header class="header">
        <div class="container">
            <a class="navbar-brand logo" href="#">
                <img src="logo.jpg" width="500" height="500" alt="Gramrite Logo">
            </a>
            <button id="modeSwitch" class="btn"><img src="brightness.png" width="40" height="37"></button>
            <button id="languageSwitch" class="btn"><img src="languages.png" width="40" height="37"></button>
            <!-- Add this button in the main content area -->
            <button class="btn1" id="relatedAppLink">Related Application</button>

        </div>
    </header>

    <!-- Latest Uploads and Trending Sections -->
    <div class="latest-container">

        <!-- Latest Uploads Section -->
        <div class="video-section-1">
            <h2>Latest Uploads</h2>
            <ul>
                <li><h4>Best way to develop UI.</h4> </li>
                <li><h4>How to dwonload Python version3 in CentOs7.</h4></li>
                <li><h4>Learn about Git.</h4> </li>
                <li><h4>Edit videos from Premier Pro 2024.</h4></li>
                <li><h4>Know about Gramrite Tech Soluction.</h4> </li>
                <li><h4>How to dwonload Python version3 in CentOs7.</h4></li>
                <!-- <li><h4>Best way to learn to develop UI.</h4> </li> -->
                
                <!-- Add more items as needed -->
            </ul>
        </div>
    </div>

    <div class="trending-container">

        <!-- Trending Section -->
        <div class="video-section-2">
            <h2>Trending Videos</h2>
            <div class="video-container">
                <iframe src="videos\Learn_How to Use Fire Extinguisher_.mp4" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>

    <main>
        <div class="container-1">
            <div id="button_container">
                <!-- Body content goes here -->
                <button class="btn"><a href="video.php">Video Gallery</a></button>
                <button class="btn"><a href="image.php">Images</a></button>
                <button class="btn"><a href="Audio.php">Audio</a></button>
                <button class="btn"><a href="documents.php">Documents</a></button>
                <button class="btn"><a href="upload_files.php">Uploaded Files</a></button>
            </div>
        </div>
    </main>


    <!-- <script>
        // Dark/Light Mode Switch
        const modeSwitch = document.getElementById('modeSwitch');
        const body = document.body;

        modeSwitch.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
        });

        // Language Switch (You can replace this with your language switch logic)
        const languageSwitch = document.getElementById('languageSwitch');
        languageSwitch.addEventListener('click', () => {
            // Implement your language switch logic here
            alert('Language switched!');
        });

    </script> -->

    <script>
        // Your existing script for mobile menu toggle
        function myFunction() {
            var x = document.getElementById("navbarNav");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>

    <script>
        // Add this script for handling the related application link button click
        document.getElementById('relatedAppLink').addEventListener('click', function() {
            // Replace 'your-related-app-url' with the actual URL of your related application
            window.location.href = 'apps.html';
        });
    </script>


    <!-- <script>
        function myFunction() {
        var x = document.getElementById("myHeader");
        if (x.className === "header") {
        x.className += " responsive";
        } else {
        x.className = "header";
      }
    }
    </script> -->


</body>

</html>


 
      
<!-- 
            <a class="navbar-brand" href="#">
                <img src="logo.png" width="200" height="100" alt="">
              </a> -->
       
      

<script>
function myFunction() {
  var x = document.getElementById("myHeader");
  if (x.className === "header") {
    x.className += " responsive";
  } else {
    x.className = "header";
  }
}
</script>

</body>
</html>

<!-- cokkie -->
<!-- // Load the Google API client library and authenticate with OAuth2 credentials
require_once 'google-api-php-client/vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig('path/to/credentials.json');
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// Define the spreadsheet ID and sheet name where you want to write the session information
$spreadsheetId = 'spreadsheet_id';
$sheetName = 'Sheet1';

// Get the session information from the cookies
$session_length = $_COOKIE['session_length'];
$mac_address = $_COOKIE['mac_address'];
$os_type = $_COOKIE['os_type'];
$device_type = $_COOKIE['device_type'];

// Format the session start time and end time as readable dates
$session_start_time = date('Y-m-d H:i:s', $session_length);
$session_end_time = date('Y-m-d H:i:s');

// Define the values you want to write to the sheet
$values = [
    [$session_start_time, $session_end_time, $mac_address, $os_type, $device_type],
];

// Define the range where you want to write the values
$range = "$sheetName!A1:E1";

// Create a new request to update the sheet with the session information
$requestBody = new Google_Service_Sheets_ValueRange([
    'values' => $values,
]);
$params = [
    'valueInputOption' => 'RAW'
];
$result = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, $params);

// Print out the result of the update
printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
 -->