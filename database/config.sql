
-- =====================================================
-- PROJET : CFPT COIFFURE
-- Base de données : cfpt_coiffure
-- SGBD : MariaDB 10.11
-- =====================================================

-- 1. Suppression et recréation de la base
DROP DATABASE IF EXISTS cfpt_coiffure;

CREATE DATABASE cfpt_coiffure
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 2. Suppression et recréation de l'utilisateur
DROP USER IF EXISTS 'cfpt_user'@'localhost';

CREATE USER 'cfpt_user'@'localhost'
IDENTIFIED BY 'cfpt_coiffure';

-- 3. Attribution des droits sur la base uniquement
GRANT ALL PRIVILEGES ON cfpt_coiffure.*
TO 'cfpt_user'@'localhost';

-- 4. Sélection de la base
USE cfpt_coiffure;

-- =====================================================
-- FIN DE LA CONFIGURATION INITIALE
-- Les tables seront ajoutées ensuite.
-- =====================================================
