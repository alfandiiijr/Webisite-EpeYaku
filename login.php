<?php
header('Content-Type: application/json');
include '../db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
if (!$email || !$password) {
  echo json_encode(['success'=>false, 'message'=>'Email/password kosong']); exit;
}
$stmt = $pdo->prepare("SELECT * FROM user WHERE email=?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user && password_verify($password, $user['password'])) {
  echo json_encode(['success'=>true, 'user'=>$user]);
} else {
  echo json_encode(['success'=>false, 'message'=>'Login gagal']);
}
?>