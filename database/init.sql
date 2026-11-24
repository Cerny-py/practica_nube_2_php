SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS gimnasio_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE gimnasio_db;

CREATE TABLE IF NOT EXISTS socios (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  nombre  VARCHAR(80)  NOT NULL,
  plan VARCHAR(50)  NOT NULL,
  estado  VARCHAR(40)  NOT NULL
);

INSERT INTO socios (nombre, plan, estado) VALUES
  ('Franco Ortiz', 'Trimestral',  'Desactivado'),
  ('Samuel Perez',    'Anual',   'Activo'),
  ('Maria Gutierres',     'Mensual',   'Activo'),
  ('Toby fox',     'Anual',  'Congelado');
