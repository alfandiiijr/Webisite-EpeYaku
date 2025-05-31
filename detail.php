<?php
header('Content-Type: application/json');
include '../db.php';

$id = $_GET['id'] ?? '';
if (!$id) {
  echo json_encode(['success'=>false, 'message'=>'ID tidak ditemukan']); exit;
}
$stmt = $pdo->prepare("SELECT * FROM aspirasi WHERE id_aspirasi=?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode(['success'=>!!$data, 'data'=>$data]);
?>