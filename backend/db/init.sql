-- Active: 1728031472035@@127.0.0.1@3306@test

CREATE TABLE IF NOT EXISTS Visiteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    nombre_jours INT NOT NULL,
    tarif_journalier DECIMAL(10,2) NOT NULL
);

INSERT INTO Visiteur (nom, nombre_jours, tarif_journalier) VALUES
('Jean Dupont', 5, 50.00),
('Marie Martin', 3, 60.50),
('Pierre Durand', 7, 45.75);