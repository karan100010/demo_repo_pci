<?php
// Start the session
session_start();

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
}

// Record device model
if (!isset($_SESSION['device_model'])) {
    $_SESSION['device_model'] = getDeviceModel($user_agent);
}

function getDeviceModel($user_agent) {
    // Determine user's device model
    // This is just one example, you can customize the function to fit your needs
    if (preg_match('/iPhone/', $user_agent)) {
        return 'iPhone';
    } elseif (preg_match('/iPad/', $user_agent)) {
        return 'iPad';
    } elseif (preg_match('/Android/', $user_agent)) {
        return 'Android';
    } else {
        return 'Unknown';
    }
}
?>
