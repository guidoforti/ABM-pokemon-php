-- =======================
-- CREACIÓN DE TABLA TIPOS
-- =======================
CREATE TABLE tipos (
                       id INT PRIMARY KEY,
                       nombre VARCHAR(255),
                       imagen_tipo VARCHAR(255)
);

-- =======================
-- INSERTS DE TIPOS
-- =======================
INSERT INTO tipos (id, nombre, imagen_tipo) VALUES
                                                (1, 'agua', '../Files/Tipos/Agua.png'),
                                                (2, 'bicho', '../Files/Tipos/Bicho.png'),
                                                (3, 'dragon', '../Files/Tipos/Dragon.png'),
                                                (4, 'electrico', '../Files/Tipos/Electrico.png'),
                                                (5, 'fantasma', '../Files/Tipos/Fantasma.png'),
                                                (6, 'fuego', '../Files/Tipos/Fuego.png'),
                                                (7, 'hada', '../Files/Tipos/Hada.png'),
                                                (8, 'hielo', '../Files/Tipos/Hielo.png'),
                                                (9, 'lucha', '../Files/Tipos/Lucha.png'),
                                                (10, 'normal', '../Files/Tipos/Normal.png'),
                                                (11, 'planta', '../Files/Tipos/Planta.png'),
                                                (12, 'psiquico', '../Files/Tipos/Psiquico.png'),
                                                (13, 'roca', '../Files/Tipos/Roca.png'),
                                                (14, 'tierra', '../Files/Tipos/Tierra.png'),
                                                (15, 'veneno', '../Files/Tipos/Veneno.png'),
                                                (16, 'volador', '../Files/Tipos/Volador.png');

-- =======================
-- CREACIÓN DE TABLA POKEMONS
-- =======================
CREATE TABLE pokemons (
                          id INT PRIMARY KEY,
                          nombre VARCHAR(255),
                          descripcion VARCHAR(255) NULL,
                          imagen_pokemon VARCHAR(255),
                          tipo_id INT NULL,
                          tipo_id_2 INT NULL,
                          CONSTRAINT fk_tipo1 FOREIGN KEY (tipo_id) REFERENCES tipos(id),
                          CONSTRAINT fk_tipo2 FOREIGN KEY (tipo_id_2) REFERENCES tipos(id)
);

-- =======================
-- INSERTS DE POKEMONS
-- =======================
INSERT INTO pokemons (id, nombre, descripcion, imagen_pokemon, tipo_id, tipo_id_2) VALUES
                                                                                       (1, 'charmander', 'este es charmander , el mejor pokemon ever', '../Files/Pockemons/charmander.png', 6, 16),
                                                                                       (2, 'squirtel', 'tortuga que tira agua', '../Files/Pockemons/squirtel.png', 1, 1),
                                                                                       (5, 'caterpie', 'bicho feo', '../Files/Pockemons/Caterpie.png', 2, 2),
                                                                                       (6, 'butterfree', 'jkhgkjhg', '../Files/Pockemons/butterfree.png', 7, 2),
                                                                                       (8, 'cikorita', 'chikorita god', '../Files/Pockemons/chikorita.png', 11, NULL),
                                                                                       (9, 'cyndaquil', 'terrible pokemon de fuego', '../Files/Pockemons/cyndaquil.png', 6, NULL),
                                                                                       (10, 'cocodile', 'cocodrilo de agua', '../Files/Pockemons/totodile.png', 1, NULL),
                                                                                       (11, 'Pikachu', 'Mítico pokemon amigo de Ash', '../Files/Pockemons/pikachu.png', 4, NULL);


-- =======================
-- CREACIÓN DE TABLA ROLES
-- =======================
CREATE TABLE roles (
                       id_rol INT PRIMARY KEY,
                       descripcion VARCHAR(255)
);

-- =======================
-- INSERTS DE ROLES
-- =======================
INSERT INTO roles (id_rol, descripcion) VALUES
                                            (1, 'ADMIN'),
                                            (2, 'USER');

-- =======================
-- CREACIÓN DE TABLA USUARIOS
-- =======================
CREATE TABLE usuarios (
                          id INT PRIMARY KEY,
                          nombre VARCHAR(255),
                          contrasenia VARCHAR(255),
                          id_rol INT,
                          CONSTRAINT fk_rol FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

-- =======================
-- INSERTS DE USUARIOS
-- =======================
INSERT INTO usuarios (id, nombre, contrasenia, id_rol) VALUES
    (3, 'guido', '1234', 1);
