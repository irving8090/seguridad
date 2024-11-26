<?php 
//Validar la existencia de la variable de sesión
if(!isset($_SESSION["validaringreso"])){
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
} else {
    if($_SESSION["validaringreso"] != "ok"){
        echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        return;
    }
}

if(!isset($_GET["id"])){
    session_destroy();

    echo '<script>
        window.location="index.php?pagina=ingreso";
    </script>';

    return;
} else {
    //tomar el dato para la consulta
    $item1 = "id";
    $valor1 = $_GET["id"];

    $alumnos = ControladorFormularios::ctrSeleccionarRegistros($item1,$valor1);
}
?>
<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="POST">

        <div class="form-group">
            <label for="nombre">Nombres:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" 
                    placeholder="Introduce los nombres"
                    value="<?php echo $alumnos["nombre"]; ?>"
                    id="nombre" name="actualizarNombre">
            </div>
            
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="text" class="form-control" 
                    placeholder="Introduce los apellidos"
                    value="<?php echo $alumnos["apellido"]; ?>"
                    id="apellido" name="actualizarApellido">
            </div>
            
        </div>
        <div class="form-group">
            <label for="matricula">Matricula</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="text" class="form-control" 
                    placeholder="Introduce tu matricula"
                    value="<?php echo $alumnos["matricula"]; ?>"
                    id="matricula" name="actualizarMatricula">
            </div>
            
        </div>


        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control" 
                    placeholder="Introduce el email"
                    value="<?php echo $alumnos["email"]; ?>"
                    id="email" name="actualizarEmail">
            </div>
            
        </div>
        <div class="form-group">
            <label for="division">Division:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="text" class="form-control" 
                    placeholder="Introduce tu division"
                    value="<?php echo $alumnos["division"]; ?>"
                    id="division" name="actualizarDivision">
            </div>
            
        </div>
        <div class="form-group">
            <label for="numero">Numero Telefonico:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="text" class="form-control" 
                    placeholder="Introduce tu numero"
                    value="<?php echo $alumnos["numero"]; ?>"
                    id="numero" name="actualizarNumero">
            </div>
            
        </div>
        

            <input type="hidden" name="id" 
            value="<?php echo $alumnos["id"]; ?>">
            
        </div>

        <?php
            $actualizar = ControladorFormularios::ctrActualizarRegistro();
            //validar si se realizó la actualización
            if($actualizar == "ok"){
                //limpiar el cache
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    </script>';
                //informar que se actualizó
                echo '<div class="alert alert-success">El usuario ha sido actualizado</div>';
                //en 3 segundos se va ha cargar la página de inicio
                echo '<script>
                    setTimeout(function(){
                        window.location = "index.php?pagina=inicio";
                    },3000);
                    </script>';

            }
            if($actualizar == "error"){
                //limpiar el cache
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    </script>';
                echo '<div class="alert alert-danger">Error al actualizar el usuario</div>';
            }
        ?> 

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>