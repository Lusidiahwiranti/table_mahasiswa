<?php
include 'db_connect.php';

$conn = getConnection();
$nama = isset($_GET["nama"]) ? $_GET["nama"] : '';

try {
    $statement = $conn->prepare("SELECT * FROM mahasiswa WHERE nama = :nama;");
    $statement->bindParam(':nama', $nama);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        $response["message"] = "Nama tidak lengkap/tidak ada di database";
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>