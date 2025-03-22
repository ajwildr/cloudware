<?php
// admin_manager_decode.php
session_start();
require '../includes/db_connect.php';
require '../vendor/autoload.php';

use Zxing\QrReader;

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['Admin', 'Manager'])) {
    // Replaced header with JavaScript redirect
    echo "<script>window.location.href = 'error.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['qr-file'])) {
    $file = $_FILES['qr-file'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filePath = $file['tmp_name'];
        
        $qrReader = new QrReader($filePath);
        $rackId = $qrReader->text();
        
        if ($rackId) {
            // Replaced header with JavaScript redirect
            echo "<script>window.location.href = 'admin_manager_details.php?rack_id=" . urlencode($rackId) . "';</script>";
            exit;
        } else {
            die("Failed to decode the QR code. Please try again.");
        }
    } else {
        die("Error uploading file. Please try again.");
    }
} else {
    die("Invalid request.");
}
?>