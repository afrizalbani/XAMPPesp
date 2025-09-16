<?php
header("Content-Type: application/json");

// Konfigurasi Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lampu_log_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal: " . $conn->connect_error]));
}

// Hanya proses request GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['device_name'])) {
        $deviceName = $_GET['device_name'];

        // Gunakan Prepared Statement untuk mencegah SQL Injection
        $sql = "SELECT ip_address FROM esp32_devices WHERE device_name = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $deviceName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(["status" => "success", "ip_address" => $row['ip_address']]);
        } else {
            echo json_encode(["status" => "error", "message" => "Perangkat tidak ditemukan atau offline."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Parameter device_name tidak ada."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}

$conn->close();
?>