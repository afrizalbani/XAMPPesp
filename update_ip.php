<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lampu_log_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['device_name']) && isset($data['ip_address'])) {
        $device_name = $data['device_name'];
        $ip_address = $data['ip_address'];
        
        // Cek apakah perangkat sudah ada di database
        $sql = "SELECT id FROM esp32_devices WHERE device_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $device_name);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Jika perangkat sudah ada, update IP Address-nya
            $sql = "UPDATE esp32_devices SET ip_address = ? WHERE device_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $ip_address, $device_name);
        } else {
            // Jika perangkat belum ada, masukkan data baru
            $sql = "INSERT INTO esp32_devices (device_name, ip_address) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $device_name, $ip_address);
        }
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "IP Address berhasil diperbarui."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui IP: " . $stmt->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}

$conn->close();
?>