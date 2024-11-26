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

$alumnos = ControladorFormularios::ctrSeleccionarRegistros(null,null);
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
                <input type="text" class="form-control" placeholder="Introduce los nombres"
                 id="nombre" name="registroNombre">
            </div>
            
        </div>
        <div class="form-group">
            <label for="apellido">Apellidos:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Introduce los apellidos"
                 id="apellido" name="registroApellido">
            </div>
            
        </div>

        
        
        <div class="form-group">
            <label for="matricula">Matricula:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Introduce la matricula"
                 id="matricula" name="registroMatricula">
            </div>

            <div class="form-group">
            <label for="email">Correo electrónico:</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input type="email" class="form-control" placeholder="Introduce el email"
                 id="email" name="registroEmail">
            </div>
            
        </div>

        <div class="form-group">
            <label for="division">Division</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Introduce la division"
                 id="divison" name="registroDivision">
            </div>
            
        <div class="form-group">
            <label for="division">Numero Telefonico</label>
            
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Introduce el numero"
                 id="numero" name="registroNumero">
            </div>
            
            
        </div>

        <?php
        
        /******************************************
        Forma de instancia a un método estactico
        *******************************************/
        $registro = ControladorFormularios::ctrRegistro();
        if($registro == "ok"){
            echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>';

            echo '<div class="alert alert-success">El usuario ha sido registrado</div>';
        } else if ($registro == "error"){
            echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>';

            echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';
        } else if ($registro != "") {
            echo '<div class="alert alert-danger">Error al registrar</div>';
        }
        ?> 

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>