<?php
// db_connect.php
// function getDBConnection() {
//     $host = "warehouse1.mysql.database.azure.com";
//     $username = "ajai";
//     $password = "Mace@123";
//     $database = "cloudware";
    
//     $conn = mysqli_connect($host, $username, $password, $database);
    
//     if (!$conn) {
//         die("Connection failed: " . mysqli_connect_error());
//     }
    
//     return $conn;
// }

// Create a global connection object
// $conn = getDBConnection();
?>

<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "warehouse";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
?>

<?php
function getDBConnection() {
    $host = "fundraiser.mysql.database.azure.com";
    $username = "sneha"; // Always use full username
    $password = "sheetal@123";
    $database = "cloudware";
    $port = 3306;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_init();

    // No SSL setup needed if disabled
    mysqli_real_connect($conn, $host, $username, $password, $database, $port);

    return $conn;
}

$conn = getDBConnection();

if ($conn) {
    // echo "Connected successfully!";
}
?>
