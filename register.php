<?php
header('Content-Type: application/json');
include '../db.php';

$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
if (!$nama || !$email || !$password) {
  echo json_encode(['success'=>false, 'message'=>'Data tidak lengkap']); exit;
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO user (nama, email, password) VALUES (?,?,?)");
$success = $stmt->execute([$nama, $email, $hash]);
echo json_encode(['success'=>$success]);
?>