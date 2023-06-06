<?php
    include 'db_connect.php';

    $conn = getConnection();

    try {
        $statement = $conn->query("SELECT * FROM mahasiswa");

        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        echo json_encode ($result, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo $e;
    }

    // Endpoint untuk pencarian data mahasiswa berdasarkan nama
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search']) && isset($_GET['nama'])) {
    $nama = $_GET['nama'];
    try {
        $sql = "SELECT * FROM mahasiswa WHERE nama LIKE :nama";
        $stmt = $koneksi->prepare($sql);
        $stmt->bindValue(':nama', "%$nama%", PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($result);
    } catch(PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

?>