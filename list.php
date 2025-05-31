<?php
header('Content-Type: application/json');
include '../db.php';

$stmt = $pdo->query("SELECT * FROM aspirasi ORDER BY tanggal DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['data'=>$data]);
?>