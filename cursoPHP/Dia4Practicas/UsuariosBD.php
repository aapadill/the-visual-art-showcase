<?php
class UsuariosBD {

  public $usuarioId;
  public $nombreUsuario;
  public $email;
  public $password;
  public $nombre;

  /**
     * Inicializa las variables de la clase
     * con el arreglo o consulta en la base de datos
     * con el id proveido e inicializa las variables del usuario.
     * 
     * 
     * @param array|int $direccion 
     * int Id de de la direccion
     * array con la siguiente estructura
     * [
        'usuario_id' => 'usuario_idValor'
        'nombre_usuario' => 'nombreUsuarioValor'
        'email' => 'emailValor'
        'password' => 'passwordValor'
        'nombre' => 'nombreValor'
     * ]
  */
  public function __construct($usuario = []) {
    $this->usuarioId = isset($usuario['usuario_id']) ? $usuario['usuario_id'] : '';
    $this->nombreUsuario = isset($usuario['nombre_usuario']) ? $usuario['nombre_usuario'] : '';
    $this->email = isset($usuario['email']) ? $usuario['email'] : '';
    $this->password = isset($usuario['password']) ? $usuario['password'] : '';
    $this->nombre = isset($usuario['nombre']) ? $usuario['nombre'] : '';
  }
  
  /**
   * Consulta todos los usuarios
   * 
   * Utiliza la query 
    SELECT *
    FROM
      usaurios
    ; 
   * @return ResultSet Resultado de todos los usuarios
  */
  public static function listar() {

  }

  /**
   * Consulta el usuario correspondiente al ID
   * Actualiza los datos faltantes de la clase
   * 
   * Utiliza la query 
    SELECT *
    FROM
      usuarios
    WHERE
      usuario_id = $usuarioId
    ; 
    * 
  */
  public function consultar() {
    
  }

  /**
  * Metodo magico para imprimir un UsuarioBD
  *  
  * @return str Representacion de un usuario
  */
  public function __toSring() {

  }

  /**
  * Validar Usuario
  * verifica que los datos no sean vacios
  *  
  * @return str Representacion de un usuario
  */
  public function validar() {

  }

  /**
  * Inserta un usuario en la tabla usuario
  *
  * Al insertar Verifica si el usuario Existe
  * Utiliza la query 
    INSERT INTO usuarios (nombre_usuario, password, email, nombre) VALUES
    ('leon', 'Hola1234', 'test@test.com', 'Leon')
    ;
  * Utiliza la query para actualizar
    UPDATE usuarios 
    SET 
      nombre_usuario = 'leon', 
      password = 'leon', 
      email = 'test@test.com', 
      nombre = 'Leon'
    WHERE
      usuario_id = usuarioId
      ;
  * @param array con los datos de usuario
  */
  public function guardar() {

  }

  /**
  * Inserta un usuario en la tabla usuario
  * Utiliza la query 
    DELETE FROM usuarios WHERE usuario_id = 123
    ;
  * @return boolean true Si se borro el usuario correctamente
  */
  public function borrar() {

  }
}


