<?php
$dsn = "mysql:host=localhost;dbname=epeyaku_db";
$user = "root"; $pass = "";
try {
  $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['success'=>false, 'message'=>'DB error']);
  exit;
}
?>