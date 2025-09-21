<?php
include("../Domain/Pokemon.php");
include("../Domain/Tipo.php");
include("../Domain/User.php");

class myDataBase
{
    private $conexion;

    public function __construct($host, $username, $password, $database)
    {
        $this->conexion = new mysqli($host, $username, $password, $database);
    }


    //---------------------------POKEMONS Y TIPOS--------------------------------------------------
    public function findAllPokemons()
    {
        $pokemons = [];
        $sql = "SELECT * FROM pokemons";

        //obtengo el resultado de la query
        $result = mysqli_query($this->conexion, $sql);
        //obtengo el array asociativo para cada fila
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        //mapeo los datos del array de objetos asociativos a objeto pokemon y lo sumo a una coleccion de pokenmons y la devuelvo
        foreach ($rows as $row) {
            $pokemon = new Pokemon();
            $pokemon->setId($row["id"]);
            $pokemon->setNombre($row["nombre"]);
            $pokemon->setDescripcion($row["descripcion"]);
            $pokemon->setImagenRuta($row["imagen_pokemon"]);
            $pokemon->setTipoUno($row["tipo_id"]);
            $pokemon->setTipoDos($row["tipo_id_2"]);
            $pokemons[] = $pokemon;
        }

        return $pokemons;

    }

    public function findPokemonById($id)
    {
        $stmt = mysqli_prepare($this->conexion, "SELECT * FROM pokemons WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);


            $pokemon = new Pokemon();
            $pokemon->setId($row["id"]);
            $pokemon->setNombre($row["nombre"]);
            $pokemon->setDescripcion($row["descripcion"]);
            $pokemon->setImagenRuta($row["imagen_pokemon"]);
            $pokemon->setTipoUno($row["tipo_id"]);
            $pokemon->setTipoDos($row["tipo_id_2"]);



        return $pokemon;
    }

    public function findPokemonByName($nombre)
    {
        $like = "%{$nombre}%";
        $stmt = mysqli_prepare($this->conexion, "SELECT * FROM pokemons WHERE nombre LIKE ?");
        mysqli_stmt_bind_param($stmt, "s", $like);
        mysqli_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        //aca traigo todas las filas no una sola
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (empty($rows)) {
            return null;
        }
        $pokemons = [];

        foreach ($rows as $row) {
            $pokemon = new Pokemon();
            $pokemon->setId($row["id"]);
            $pokemon->setNombre($row["nombre"]);
            $pokemon->setDescripcion($row["descripcion"]);
            $pokemon->setImagenRuta($row["imagen_pokemon"]);
            $pokemon->setTipoUno($row["tipo_id"]);
            $pokemon->setTipoDos($row["tipo_id_2"]);
            $pokemons[] = $pokemon;
        }

        return $pokemons;
    }

    public function findPokemonsByTipo($nombreTipo)
    {
        $pokemons = [];


        $stmtTipo = mysqli_prepare($this->conexion, "SELECT id FROM tipos WHERE LOWER(nombre) = LOWER(?)");
        mysqli_stmt_bind_param($stmtTipo, "s", $nombreTipo);
        mysqli_stmt_execute($stmtTipo);
        $resultTipo = mysqli_stmt_get_result($stmtTipo);
        $rowTipo = mysqli_fetch_assoc($resultTipo);

        if (!$rowTipo) {
            return null;
        }

        $tipoId = $rowTipo['id'];


        $sql = "SELECT 
                p.id, p.nombre, p.descripcion, p.imagen_pokemon,
                p.tipo_id, p.tipo_id_2
            FROM pokemons p
            INNER JOIN tipos t1 ON p.tipo_id = t1.id
            LEFT JOIN tipos t2 ON p.tipo_id_2 = t2.id
            WHERE p.tipo_id = ? OR p.tipo_id_2 = ?";

        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $tipoId, $tipoId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (empty($rows)) {
            return null;
        }

        foreach ($rows as $row) {
            $pokemon = new Pokemon();
            $pokemon->setId($row["id"]);
            $pokemon->setNombre($row["nombre"]);
            $pokemon->setDescripcion($row["descripcion"]);
            $pokemon->setImagenRuta($row["imagen_pokemon"]);
            $pokemon->setTipoUno($row["tipo_id"]);
            $pokemon->setTipoDos($row["tipo_id_2"]);
            $pokemons[] = $pokemon;
        }

        return $pokemons;
    }


    public function findAllTipos()
    {
        $sql = "SELECT * FROM tipos";
        $result = mysqli_query($this->conexion, $sql);
        $datosADevolver = $result->fetch_all(MYSQLI_ASSOC);
        return $datosADevolver;
    }

    public function guardarPockemon(Pokemon $pokemon)
    {
        $nombre = $pokemon->getNombre();
        $descripcion = $pokemon->getDescripcion();
        $imagenRuta = $pokemon->getImagenRuta();
        $tipoUnoId = $pokemon->getTipoUno();
        $tipoDosId = $pokemon->getTipoDos();
        $stmt = mysqli_prepare($this->conexion,
            "INSERT INTO pokemons (nombre , descripcion, imagen_pokemon , tipo_id , tipo_id_2) 
                    VALUES (? , ? , ? , ? , ? )");
        mysqli_stmt_bind_param($stmt, "sssii", $nombre, $descripcion, $imagenRuta, $tipoUnoId, $tipoDosId);
        $result = mysqli_stmt_execute($stmt);
        if ($result == false) {
            echo "ERROR : " . mysqli_error($this->conexion);
        }
        mysqli_stmt_close($stmt);
    }

    public function deletePokemonById($id)
    {
        $stmt = mysqli_prepare($this->conexion, "DELETE FROM pokemons WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);
        if ($result == false) {
            return false;
        }
        return  true;
    }


    public function guardarTipo(Tipo $tipo)
    {

        $stmt = mysqli_prepare($this->conexion, "INSERT INTO tipos (nombre, imagen_tipo)
                                                        VALUES (? , ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nombreTipo, $rutaImagenTipo);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false) {
            echo "Error : " . mysqli_error($this->conexion);
        }
    }

    public function obtenerIdDeTipoSegunNombre($nombreTipo)
    {
        $stmt = mysqli_prepare($this->conexion, "SELECT id FROM tipos where nombre = ? ");
        mysqli_stmt_bind_param($stmt, "s", $nombreTipo);
        mysqli_stmt_execute($stmt);

        //obtengo el restultado del execute
        $result = mysqli_stmt_get_result($stmt);
        //obtengo los datos de la fila
        $rowData = mysqli_fetch_assoc($result);

        //devuelvo el id de la row
        return $rowData['id'];

    }

    public function obtenerRutaImagenTipoSegunId($id)
    {
        $stmt = mysqli_prepare($this->conexion, "SELECT imagen_tipo FROM tipos where id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        //obtengo resultado
        $result = mysqli_stmt_get_result($stmt);
        //obtengo los datos de la fila en un array
        $row = mysqli_fetch_assoc($result);

        if ($result && $row) {
            return $row['imagen_tipo'];
        } else {
            return null;
        }


    }

    public function obtenerDescripcionTipoSegunId($id)
    {
        $stmt = mysqli_prepare($this->conexion, "SELECT nombre FROM tipos where id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        //obtengo resultado
        $result = mysqli_stmt_get_result($stmt);
        //obtengo los datos de la fila en un array
        $row = mysqli_fetch_assoc($result);

        if ($result && $row) {
            return $row['nombre'];
        } else {
            return null;
        }


    }

    public function obtenerTodosLosTiposDescripcion() {
        $tipos = array();
        $sql = "SELECT nombre FROM tipos";
        $result = mysqli_query($this->conexion, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tipos[] = $row['nombre'];
            }
            mysqli_free_result($result);
        }

        return $tipos;
    }

    public function updatePokemon($id, $nombre, $descripcion, $tipoUno, $tipoDos) {
        // Si $tipoDos es null lo dejamos como NULL en la tabla
        $tipoDosValor = $tipoDos ?: null;

        $sql = "UPDATE pokemons 
            SET nombre = ?, 
                descripcion = ?, 
                tipo_id = ?, 
                tipo_id_2 = ? 
            WHERE id = ?";

        $stmt = mysqli_prepare($this->conexion, $sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . mysqli_error($this->conexion));
        }


        mysqli_stmt_bind_param($stmt, "ssiii", $nombre, $descripcion, $tipoUno, $tipoDosValor, $id);

        $execute = mysqli_stmt_execute($stmt);

        if($execute == false) {
            return  false;
        }
        return true;
    }

    public function obtenerIdDeTipoSegunDescripcion($descripcion)
    {
        $stmt = mysqli_prepare($this->conexion , "SELECT id FROM tipos where nombre = ?");
        mysqli_stmt_bind_param($stmt , "s", $descripcion);
        mysqli_execute($stmt);
        //obtengo resultado
        $result = mysqli_stmt_get_result($stmt);
        //obtengo los datos de la fila en un array
        $row = mysqli_fetch_assoc($result);

        if ($row == null){
            return null;
        }
        return $row["id"];

    }



    //---------------------------USUARIOS Y ROLES--------------------------------------------------

    public function guardarUsuario($userName, $password, $rol)
    {

        $idRol = 0;
        if ($rol === "ADMIN") {
            $idRol = 1;
        } elseif ($rol === "USER") {
            $idRol = 2;
        } else {
            $idRol = 2;
        }
        $stmt = mysqli_prepare($this->conexion, "INSERT INTO usuarios (nombre, contrasenia, id_rol) values (? , ? , ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $userName, $password, $idRol);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false) {
            echo "Error : " . mysqli_error($this->conexion);
            return null; // Devolver null en caso de error
        } else {
            // Obtenemos el ID que la BD acaba de generar
            $last_id = mysqli_insert_id($this->conexion);
            // Creamos y devolvemos el objeto User con todos sus datos
            return new User($last_id, $userName, $password, $idRol);
        }


    }

    public function borrarUsuario($id)
    {
        $stmt = mysqli_prepare($this->conexion, "DELETE FROM usuarios WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false) {
            echo "Error : " . mysqli_error($this->conexion);
        }

    }

    public function obtenerDescripcionRolParaIdUsuario($idRolUsuario)
    {
        $stmt = mysqli_prepare($this->conexion, "SELECT  r.descripcion FROM usuarios u INNER JOIN roles r on u.id_rol  = r.id_rol where u.id = ?");
        mysqli_stmt_bind_param($stmt, "i", $idRolUsuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($result);

        return $row['descripcion'];

    }

    public  function usuarioExistByName ($userName)
    {
        $existeByName = false;
        $stmt = mysqli_prepare($this->conexion , "SELECT * FROM usuarios where nombre = ?");
        mysqli_stmt_bind_param($stmt , "s" , $userName);
        mysqli_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $existeByName = true;
        }

        return $existeByName;
    }

    public function obtenerUsuarioAlLoguear($username, $password)
    {
        $stmt = mysqli_prepare($this->conexion , "SELECT * FROM usuarios where nombre = ? and contrasenia = ?");
        mysqli_stmt_bind_param($stmt , "ss" , $username, $password);
        mysqli_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            $usuarioADevolver = new User($row['id'] , $row['nombre'] , $row['contrasenia'] , $row['id_rol']);
            return $usuarioADevolver;
        } else {
            return null;
        }

    }

    public function __destruct()
    {
        $this->conexion->close();
    }
}