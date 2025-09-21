CREATE TABLE tipos
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(50)  NOT NULL,
    imagen_tipo VARCHAR(255) NOT NULL
);


CREATE TABLE pokemons
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(50)  NOT NULL,
    descripcion    VARCHAR(1000),
    imagen_pokemon VARCHAR(255) NOT NULL,
    tipo_id        INT,
    tipo_id_2      INT,
    FOREIGN KEY (tipo_id) REFERENCES tipos (id)
        FOREIGN KEY (tipo_id_2) REFERENCES tipos(id)

);