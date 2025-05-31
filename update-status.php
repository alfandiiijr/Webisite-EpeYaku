<?php
header('Content-Type: application/json');
include '../db.php';

$id = $_POST['id'] ?? '';
$status = $_POST['status'] ?? '';
if (!$id || !$status) {
  echo json_encode(['success'=>false, 'message'=>'Data tidak lengkap']); exit;
}
$stmt = $pdo->prepare("UPDATE aspirasi SET status=? WHERE id_aspirasi=?");
$success = $stmt->execute([$status, $id]);
echo json_encode(['success'=>$success]);
?>