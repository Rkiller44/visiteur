<?php
require_once '../db/config.php';

$stmt = $pdo->query("
    SELECT 
        SUM(nombre_jours * tarif_journalier) as total,
        MIN(nombre_jours * tarif_journalier) as minimal,
        MAX(nombre_jours * tarif_journalier) as maximal,
        COUNT(id) as count
    FROM Visiteur
");
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
