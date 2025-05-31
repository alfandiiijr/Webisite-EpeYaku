<?php
header('Content-Type: application/json');
include '../db.php';

$id = $_POST['id'] ?? '';
if (!$id) {
  echo json_encode(['success'=>false, 'message'=>'ID tidak ditemukan']); exit;
}
$stmt = $pdo->prepare("DELETE FROM aspirasi WHERE id_aspirasi=?");
$success = $stmt->execute([$id]);
echo json_encode(['success'=>$success]);
?>