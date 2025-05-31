<?php
header('Content-Type: application/json');
include '../db.php';

$id = $_POST['id_aspirasi'] ?? '';
$judul = $_POST['judul'] ?? '';
$isi = $_POST['isi'] ?? '';
$pengirim = $_POST['pengirim'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$tanggal = $_POST['tanggal'] ?? date('Y-m-d');
$status = $_POST['status'] ?? 'Terkirim';

if (!$id || !$judul || !$isi || !$pengirim) {
  echo json_encode(['success'=>false, 'message'=>'Data tidak lengkap']); exit;
}
$stmt = $pdo->prepare("INSERT INTO aspirasi VALUES (?,?,?,?,?,?,?)");
$success = $stmt->execute([$id, $judul, $isi, $pengirim, $kategori, $tanggal, $status]);
echo json_encode(['success'=>$success]);
?>