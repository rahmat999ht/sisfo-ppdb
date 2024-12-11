<?php
// delete.php
session_start();
require_once("../../koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data JSON dari permintaan
    $data = json_decode(file_get_contents('php://input'), true);

    // Validasi apakah aksi dan ID ada di permintaan
    if (isset($data['action'], $data['id']) && $data['action'] === 'delete') {
        $pesertaId = $data['id'];

        // Query untuk menghapus data peserta
        $sql = "DELETE FROM peserta WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $pesertaId);

        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Peserta berhasil dihapus.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Gagal menghapus peserta. Coba lagi.'
            ];
        }

        $stmt->close();
    } else {
        $response = [
            'success' => false,
            'message' => 'Permintaan tidak valid.'
        ];
    }

    // Mengirimkan respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'success' => false,
        'message' => 'Metode permintaan tidak diizinkan.'
    ]);
}
