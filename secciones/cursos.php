<?php 
include_once("../configuracion/bd.php");
$conexionBD=BD::crearInstancia();
$id=isset($_POST['id'])?$_POST['id']:"";
$nombre=isset($_POST['nombre'])?$_POST['nombre']:"";
if(isset($_POST['accion'])){
    switch($_POST['accion']){
        case "agregar":
         

            $sql="INSERT INTO cursos (id,nombre_curso) VALUES (null,:nombre_curso)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(":nombre_curso",$nombre);
            $consulta->execute();
            
            break;
        case "editar":
        
            $sql="UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(":nombre_curso",$nombre);
            $consulta->bindParam(":id",$id);
            $consulta->execute();

            break;
        case "borrar":
           
            $sql="DELETE FROM cursos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(":id",$id);
            $consulta->execute();

            break;

        case "seleccionar":
             
             
                $sql="SELECT * FROM cursos WHERE id=:id";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(":id",$id);
                $consulta->execute(); 
                $datosCurso=($consulta->fetchAll());
            
                $nombre=$datosCurso[0]["nombre_curso"];

            break;

    }
}

$consulta=$conexionBD->prepare("SELECT * FROM cursos");
$consulta->execute();
$listaCursos=$consulta->fetchAll();

?>