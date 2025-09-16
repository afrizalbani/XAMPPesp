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

// Hanya proses request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Baca data JSON mentah dari body request
    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);

    // Pastikan semua data yang dibutuhkan ada
    if (isset($data['status_lampu']) && isset($data['sumber']) && isset($data['waktu_menyala']) && isset($data['waktu_padam']) && isset($data['lama_menyala_detik'])) {
        $status_lampu = $data['status_lampu'];
        $sumber = $data['sumber'];
        $waktu_menyala = $data['waktu_menyala'];
        $waktu_padam = $data['waktu_padam'];
        $lama_menyala_detik = $data['lama_menyala_detik'];

        // Gunakan Prepared Statement untuk mencegah SQL Injection
        $sql = "INSERT INTO lampu_log (status_lampu, sumber, waktu_menyala, waktu_padam, lama_menyala_detik) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $status_lampu, $sumber, $waktu_menyala, $waktu_padam, $lama_menyala_detik);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Log berhasil disimpan."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan log: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}

$conn->close();
?>