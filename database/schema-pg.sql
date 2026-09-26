-- Tour And Travel Touch - PostgreSQL Schema (Neon free tier)
-- Import ONCE via Neon SQL editor. Data persists; free projects sleep, never delete.
--
-- Tables mirror database/schema.sql (MySQL) for the PDO backend.

-- Booking inquiries table
CREATE TABLE IF NOT EXISTS information (
    id SERIAL PRIMARY KEY,
    whereto VARCHAR(255) NOT NULL,
    howmany VARCHAR(50) NOT NULL,
    arrival DATE NOT NULL,
    leaving DATE NOT NULL,
    textdata TEXT,
    user_id INTEGER DEFAULT NULL,
    user_name VARCHAR(255) DEFAULT NULL,
    user_email VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_user_id ON information (user_id);
CREATE INDEX IF NOT EXISTS idx_user_email ON information (user_email);

-- User accounts table
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_email ON users (email);

-- Admin accounts table
CREATE TABLE IF NOT EXISTS admins (
    id SERIAL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
