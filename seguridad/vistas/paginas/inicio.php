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
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Matricula</th>
            <th>Email</th>
            <th>Division</th>
            <th>Numero Telefonico</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($alumnos as $key => $value): ?>
        <tr>
            <td><?php echo ($key + 1); ?></td>
            <td><?php echo $value["nombre"]; ?></td>
            <td><?php echo $value["apellido"]; ?></td>
            <td><?php echo $value["matricula"]; ?></td>
            <td><?php echo $value["email"]; ?></td>
            <td><?php echo $value["division"]; ?></td>
            <td><?php echo $value["numero"]; ?></td>
            <td><?php echo $value["fecha"]; ?></td>
            <td>
                <div class="btn-group">
                    <div class="px-1">
                        <a href="index.php?pagina=editar&id=<?php echo $value["id"]; ?>" 
                        
                        class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                    </div>

                    <form method="post">
                        <input type="hidden" name="eliminarRegistro" value="<?php echo $value["id"]; ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <?php 
                            $eliminar = new ControladorFormularios();
                            $eliminar->ctrEliminarRegistro();
                        ?>
                    </form>
                    
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>