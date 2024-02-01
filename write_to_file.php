<?php
// Start the session
session_start();

// Check if file exists
if (!file_exists('session_data.txt')) {
    // Create file
    $fp = fopen('session_data.txt', 'w');
    fclose($fp);
}

// Write the session details to the file
$session_id = session_id();
$device_model = $_SESSION['device_model'];
$button_clicks = implode(',', $_SESSION['button_clicks']);
$data = "$session_id,$device_model,$button_clicks
";
file_put_contents('session_data.txt', $data, FILE_APPEND | LOCK_EX);
?>
