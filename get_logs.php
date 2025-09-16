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
    // Ambil 50 log terbaru, diurutkan dari yang paling baru
    $sql = "SELECT status_lampu, sumber, waktu_menyala, waktu_padam, lama_menyala_detik FROM lampu_log ORDER BY waktu_padam DESC LIMIT 50";
    $result = $conn->query($sql);

    $logs = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $logs[] = $row;
        }
    }

    echo json_encode(["status" => "success", "logs" => $logs]);
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}

$conn->close();
?>