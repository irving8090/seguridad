<?php

require_once "conexion.php";

class ModeloFormularios{

    /**********************
     * Registro
     ********************/

     
    static public function mdlRegistro($tabla1, $datos1){
        #statement --- declaración del sql
        #prepare() --- Pararar la sensencia

       // Verificar si algún campo está vacío
    foreach ($datos1 as $key => $value1) {
        if (empty($value1)) {
            return "Error: El campo '$key' no puede estar vacío.";
        }
    }

    // Verificar que 'nombre' y 'apellido' contengan solo letras
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $datos1["nombre"])) {
        return "Error: El campo 'nombre' solo puede contener letras.";
    }

    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $datos1["apellido"])) {
        return "Error: El campo 'apellido' solo puede contener letras.";
    }

    // Verificar que el campo 'matricula' contenga solo números
    if (!is_numeric($datos1["matricula"])) {
        return "Error: El campo 'matricula' debe contener solo números.";
    }

    // Verificar que el campo 'email' tenga un formato válido
    if (!filter_var($datos1["email"], FILTER_VALIDATE_EMAIL)) {
        return "Error: El campo 'email' no tiene un formato válido.";
    }

    // Verificar que 'division' y 'numero' no contengan caracteres no deseados (ajustar según necesidad)
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $datos1["division"])) {
        return "Error: El campo 'division' solo puede contener letras y números.";
    }

    if (!preg_match("/^[0-9]+$/", $datos1["numero"])) {
        return "Error: El campo 'numero' debe contener solo números.";
    }

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla1 (id,nombre, apellido,matricula, email, division, numero) 
            VALUES (:id,:nombre, :apellido, :matricula, :email, :division, :numero) ");
        
        #bindParam() vincular los parámetros

        $stmt->bindParam(":id",$datos1["id"],PDO::PARAM_STR);
        $stmt->bindParam(":nombre",$datos1["nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":apellido",$datos1["apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":matricula",$datos1["matricula"],PDO::PARAM_STR);
        $stmt->bindParam(":email",$datos1["email"],PDO::PARAM_STR);
        $stmt->bindParam(":division",$datos1["division"],PDO::PARAM_STR);
        $stmt->bindParam(":numero",$datos1["numero"],PDO::PARAM_STR);
        

        #Ejecutar y verificar
        if ($stmt->execute()){
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        //cerrar la conexión
        $stmt->close();
        $stmt = null();
    }


    /************************
     * Seleccionar Registros ADMIN
     ************************/
    static public function mdlSeleccionarRegistros($tabla,$item,$valor){
        if($item == null && $valor == null){
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

    }

    /************************
     * Seleccionar Registros ALUMNOS
     ************************/
    static public function mdlSeleccionarRegistros1($tabla1,$item1,$valor1){
        if($item1 == null && $valor1 == null){
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla1 ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla1 WHERE $item1 = :$item1 ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

    }

    /************************
     * Actualizar Registros
     ************************/
    static public function mdlActualizarRegistro($tabla1, $datos1){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET id=:id, nombre=:nombre, apellido=:apellido,
        matricula=:matricula, email=:email, division=:division, numero=:numero WHERE id=:id");
        //pasar los parámetros
        $stmt->bindParam(":id", $datos1["id"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre",$datos1["nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":apellido",$datos1["apeliido"],PDO::PARAM_STR);
        $stmt->bindParam(":matricula",$datos1["matricula"],PDO::PARAM_STR);
        $stmt->bindParam(":email",$datos1["email"],PDO::PARAM_STR);
        $stmt->bindParam(":division",$datos1["division"],PDO::PARAM_STR);
        $stmt->bindParam(":numero",$datos1["numero"],PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos1["id"], PDO::PARAM_STR);
        

        if($stmt->execute()){
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }

    /************************
     * Eliminar Registro
     ************************/
    static public function mdlEliminarRegistro($tabla1, $valor1){

        

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla1 WHERE id=:id");
        $stmt->bindParam(":id", $valor1, PDO::PARAM_STR);
        if($stmt->execute()){
            return "ok";
        } else {
            
            print_r(Conexion::conectar()->errorInfo());
        }
    }
}
