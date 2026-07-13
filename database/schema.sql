CREATE DATABASE IF NOT EXISTS centro_salud
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE centro_salud;

-- ============================
-- TABLA ROLES
-- ============================
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- ============================
-- TABLA USERS (Login)
-- ============================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_users_roles
    FOREIGN KEY (role_id)
    REFERENCES roles(id)
);

-- ============================
-- TABLA ESPECIALIDADES
-- ============================
CREATE TABLE especialidades (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- ============================
-- TABLA DOCTORES
-- ============================
CREATE TABLE doctores (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    especialidad_id BIGINT UNSIGNED NOT NULL,

    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100),

    cedula_profesional VARCHAR(30) NOT NULL UNIQUE,

    telefono VARCHAR(15),
    correo VARCHAR(150),

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_doctor_user
        FOREIGN KEY (user_id)
        REFERENCES users(id),

    CONSTRAINT fk_doctor_especialidad
        FOREIGN KEY (especialidad_id)
        REFERENCES especialidades(id)
);

-- ============================
-- TABLA PACIENTES
-- ============================
CREATE TABLE pacientes (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100),

    sexo ENUM('Masculino','Femenino') NOT NULL,

    fecha_nacimiento DATE,

    curp VARCHAR(18) UNIQUE,

    telefono VARCHAR(15),

    correo VARCHAR(150),

    direccion TEXT,

    codigo_postal VARCHAR(5),

    estado VARCHAR(80),

    municipio VARCHAR(80),

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL

);

-- ============================
-- TABLA CITAS
-- ============================
CREATE TABLE citas (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    paciente_id BIGINT UNSIGNED NOT NULL,

    doctor_id BIGINT UNSIGNED NOT NULL,

    fecha DATE NOT NULL,

    hora TIME NOT NULL,

    motivo TEXT NOT NULL,

    estado ENUM(
        'Pendiente',
        'Confirmada',
        'Cancelada',
        'Finalizada'
    ) DEFAULT 'Pendiente',

    observaciones TEXT,

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_cita_paciente
        FOREIGN KEY (paciente_id)
        REFERENCES pacientes(id),

    CONSTRAINT fk_cita_doctor
        FOREIGN KEY (doctor_id)
        REFERENCES doctores(id)

);

-- ============================
-- TABLA CONSULTAS
-- ============================
CREATE TABLE consultas (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    cita_id BIGINT UNSIGNED NOT NULL UNIQUE,

    diagnostico TEXT,

    tratamiento TEXT,

    receta TEXT,

    peso DECIMAL(5,2),

    talla DECIMAL(5,2),

    temperatura DECIMAL(4,2),

    presion_arterial VARCHAR(20),

    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_consulta_cita
        FOREIGN KEY (cita_id)
        REFERENCES citas(id)

);