<?php
require_once '../db/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT *, (nombre_jours * tarif_journalier) as tarif FROM Visiteur");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO Visiteur (nom, nombre_jours, tarif_journalier) VALUES (?, ?, ?)");
        $success = $stmt->execute([$data['nom'], $data['nombre_jours'], $data['tarif_journalier']]);
        echo json_encode(['success' => $success, 'message' => $success ? 'Insertion réussie' : 'Insertion échouée']);
        break;
        
    case 'PUT':
        parse_str(file_get_contents('php://input'), $data);
        $stmt = $pdo->prepare("UPDATE Visiteur SET nom = ?, nombre_jours = ?, tarif_journalier = ? WHERE id = ?");
        $success = $stmt->execute([$data['nom'], $data['nombre_jours'], $data['tarif_journalier'], $data['id']]);
        echo json_encode(['success' => $success, 'message' => $success ? 'Modification réussie' : 'Modification échouée']);
        break;
        
    case 'DELETE':
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM Visiteur WHERE id = ?");
        $success = $stmt->execute([$id]);
        echo json_encode(['success' => $success, 'message' => $success ? 'Suppression réussie' : 'Suppression échouée']);
        break;
}
