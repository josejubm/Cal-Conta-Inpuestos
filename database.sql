
-- Tabla de Contadores
CREATE TABLE contadores (
    cedula_profesional VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    rfc VARCHAR(13) UNIQUE,
    especialidad VARCHAR(100),
    fecha_titulacion DATE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Roles
CREATE TABLE roles (
    rol_id INT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    usuario_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    contador_cedula VARCHAR(20),
    rol_id INT,
    FOREIGN KEY (contador_cedula) REFERENCES contadores(cedula_profesional),
    FOREIGN KEY (rol_id) REFERENCES roles(rol_id)
);

-- Tabla de Contribuyentes
CREATE TABLE contribuyentes (
    rfc_contribuyente VARCHAR(13) PRIMARY KEY,
    curp_contribuyente VARCHAR(18) UNIQUE,
    nombre_contribuyente VARCHAR(100) NOT NULL,
    direccion_contribuyente VARCHAR(255),
    telefono_contribuyente VARCHAR(15),
    fecha_registro_contribuyente TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Relación Contadores-Contribuyentes
CREATE TABLE relacion_contadores_contribuyentes (
    relacion_id INT PRIMARY KEY,
    cedula_contador VARCHAR(20),
    rfc_contribuyente VARCHAR(13),
    FOREIGN KEY (cedula_contador) REFERENCES contadores(cedula_profesional),
    FOREIGN KEY (rfc_contribuyente) REFERENCES contribuyentes(rfc_contribuyente)
);

-- Tabla de Gastos Mensuales
CREATE TABLE gastos_mensuales (
    gasto_id INT PRIMARY KEY,
    rfc_contribuyente VARCHAR(13),
    mes INT,
    anio INT,
    monto DECIMAL(10, 2),
    FOREIGN KEY (rfc_contribuyente) REFERENCES contribuyentes(rfc_contribuyente)
);

-- Tabla de Categorías
CREATE TABLE categorias (
    categoria_id INT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL
);

-- Tabla de Ingresos y Deducciones o Gastos
CREATE TABLE ingresos_deducciones (
    registro_id INT PRIMARY KEY,
    rfc_contribuyente VARCHAR(13),
    mes INT,
    anio INT,
    categoria_id INT,
    monto DECIMAL(10, 2),
    es_ingreso BOOLEAN,
    FOREIGN KEY (rfc_contribuyente) REFERENCES contribuyentes(rfc_contribuyente),
    FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
);


-- Datos para la tabla `contadores`
INSERT INTO contadores VALUES
('0123456789', 'Juan', 'Pérez', 'juan.perez@example.com', '555-1234', 'PRJU012345', 'Contador Público', '2000-05-15', '2023-12-12 10:30:00'),
('9876543210', 'María', 'Gómez', 'maria.gomez@example.com', '555-5678', 'GOMA987654', 'Auditor Financiero', '2005-08-20', '2023-12-12 11:45:00');

-- Datos para la tabla `roles`
INSERT INTO roles VALUES
(1, 'Administrador'),
(2, 'Contador');

-- Datos para la tabla `usuarios`
INSERT INTO usuarios VALUES
(1, 'admin', 'admin', '0123456789', 1),
(2, 'contador1', 'contador', '9876543210', 2);

-- Datos para la tabla `contribuyentes`
INSERT INTO contribuyentes VALUES
('RFC123456789', 'CURPABCDEF12345678', 'Empresa ABC', 'Av. Principal 123', '555-9876', '2023-12-12 13:15:00'),
('RFC987654321', 'CURPXYZ12345678901', 'Empresa XYZ', 'Calle Secundaria 456', '555-4321', '2023-12-12 14:30:00');

-- Datos para la tabla `relacion_contadores_contribuyentes`
INSERT INTO relacion_contadores_contribuyentes VALUES
(1, '0123456789', 'RFC123456789'),
(2, '9876543210', 'RFC987654321');

-- Datos para la tabla `gastos_mensuales`
INSERT INTO gastos_mensuales VALUES
(1, 'RFC123456789', 1, 2023, 1500.00),
(2, 'RFC987654321', 1, 2023, 2000.00);

-- Datos para la tabla `categorias`
INSERT INTO categorias VALUES
(1, 'Gastos Operativos'),
(2, 'Gastos de Personal'),
(3, 'Gastos Financieros');

-- Datos para la tabla `ingresos_deducciones`
INSERT INTO ingresos_deducciones VALUES
(1, 'RFC123456789', 1, 2023, 1, 5000.00, 1),
(2, 'RFC987654321', 1, 2023, 2, 3000.00, 1),
(3, 'RFC123456789', 2, 2023, 3, 1000.00, 2);

