
-- =====================================================
-- CFPT COIFFURE
-- Structure initiale de la base de données
-- MariaDB 10.11
-- =====================================================

USE cfpt_coiffure;

-- -----------------------------------------------------
-- 1. UTILISATEURS
-- Clients, barbiers et administrateur
-- -----------------------------------------------------

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('client', 'barber', 'admin') NOT NULL DEFAULT 'client',
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- 2. SERVICES
-- Prestations proposées par le salon
-- -----------------------------------------------------

CREATE TABLE services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT DEFAULT NULL,
    duration_minutes SMALLINT UNSIGNED NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT chk_service_duration
        CHECK (duration_minutes > 0),

    CONSTRAINT chk_service_price
        CHECK (price >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- 3. RENDEZ-VOUS
-- Un client réserve auprès d'un barbier
-- -----------------------------------------------------

CREATE TABLE appointments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_id INT UNSIGNED NOT NULL,
    barber_id INT UNSIGNED NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    total_duration SMALLINT UNSIGNED NOT NULL,
    total_price DECIMAL(8,2) NOT NULL,
    status ENUM(
        'confirmed',
        'cancelled',
        'completed',
        'no_show'
    ) NOT NULL DEFAULT 'confirmed',
    created_by INT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT chk_appointment_dates
        CHECK (end_at > start_at),

    CONSTRAINT fk_appointment_client
        FOREIGN KEY (client_id) REFERENCES users(id),

    CONSTRAINT fk_appointment_barber
        FOREIGN KEY (barber_id) REFERENCES users(id),

    CONSTRAINT fk_appointment_creator
        FOREIGN KEY (created_by) REFERENCES users(id)
        ON DELETE SET NULL,

    INDEX idx_appointment_barber_date (barber_id, start_at),
    INDEX idx_appointment_client_date (client_id, start_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- 4. SERVICES DES RENDEZ-VOUS
-- Copie du nom, du prix et de la durée au moment
-- de la réservation pour conserver l'historique
-- -----------------------------------------------------

CREATE TABLE appointment_services (
    appointment_id INT UNSIGNED NOT NULL,
    service_id INT UNSIGNED NOT NULL,
    service_name VARCHAR(150) NOT NULL,
    duration_minutes SMALLINT UNSIGNED NOT NULL,
    price DECIMAL(8,2) NOT NULL,

    PRIMARY KEY (appointment_id, service_id),

    CONSTRAINT fk_appointment_services_appointment
        FOREIGN KEY (appointment_id)
        REFERENCES appointments(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_appointment_services_service
        FOREIGN KEY (service_id)
        REFERENCES services(id),

    CONSTRAINT chk_appointment_service_duration
        CHECK (duration_minutes > 0),

    CONSTRAINT chk_appointment_service_price
        CHECK (price >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- 5. HORAIRES D'OUVERTURE
-- 1 = lundi, 7 = dimanche
-- -----------------------------------------------------

CREATE TABLE opening_hours (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    day_of_week TINYINT UNSIGNED NOT NULL UNIQUE,
    open_time TIME DEFAULT NULL,
    close_time TIME DEFAULT NULL,
    break_start TIME DEFAULT NULL,
    break_end TIME DEFAULT NULL,
    is_open BOOLEAN NOT NULL DEFAULT TRUE,

    CONSTRAINT chk_opening_day
        CHECK (day_of_week BETWEEN 1 AND 7)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- 6. FERMETURES ET ABSENCES
-- barber_id NULL = fermeture du salon
-- barber_id renseigné = absence d'un barbier
-- -----------------------------------------------------

CREATE TABLE closures (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    barber_id INT UNSIGNED DEFAULT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    reason VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT chk_closure_dates
        CHECK (end_at > start_at),

    CONSTRAINT fk_closure_barber
        FOREIGN KEY (barber_id) REFERENCES users(id),

    INDEX idx_closure_dates (start_at, end_at),
    INDEX idx_closure_barber (barber_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
