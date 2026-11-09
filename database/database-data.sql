
-- ==========================================
-- CFPT COIFFURE : DONNEES INITIALES
-- ==========================================

-- 1. Horaires d'ouverture
INSERT INTO opening_hours
    (day_of_week, open_time, close_time, break_start, break_end, is_open)
VALUES
    (1, NULL, NULL, NULL, NULL, 0),
    (2, '09:00:00', '19:00:00', '12:00:00', '13:00:00', 1),
    (3, '09:00:00', '19:00:00', '12:00:00', '13:00:00', 1),
    (4, '09:00:00', '19:00:00', '12:00:00', '13:00:00', 1),
    (5, '09:00:00', '19:00:00', '12:00:00', '13:00:00', 1),
    (6, '09:00:00', '19:00:00', '12:00:00', '13:00:00', 1),
    (7, '09:00:00', '17:00:00', '12:00:00', '13:00:00', 1);

-- 2. Prestations
INSERT INTO services
    (name, description, duration_minutes, price)
VALUES
    ('Coupe classique', NULL, 30, 35.00),
    ('Dégradé (Fade)', NULL, 40, 40.00),
    ('Coupe aux ciseaux', NULL, 40, 40.00),
    ('Taille de barbe', NULL, 25, 25.00),
    ('Coupe + barbe', NULL, 60, 55.00),
    ('Rasage traditionnel', NULL, 30, 35.00),
    ('Contours et finitions', NULL, 15, 15.00),
    ('Shampoing', NULL, 10, 10.00),
    ('Coiffage', NULL, 15, 15.00),
    ('Coloration', NULL, 90, 80.00),
    ('Décoloration', NULL, 120, 100.00),
    ('Permanente', NULL, 90, 80.00);
