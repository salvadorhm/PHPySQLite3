<?php 
    try {
        include("conexion.php");

        $offset = (int) $_GET["offset"];
        $limit = (int) $_GET["limit"];

        if($limit==0){
            $limit=10;
        }
        if($offset<0){
            $offset=0;
        }
        
        if($database=="MySQL"){
            $sentencia = $db->prepare("SELECT id_cliente,nombre,email FROM  clientes limit ?, ?;");
            $sentencia->bindParam(1, $offset, PDO::PARAM_INT);
            $sentencia->bindParam(2, $limit, PDO::PARAM_INT);
        }else if($database=="SQLite"){
            $sentencia = $db->prepare("SELECT id_cliente,nombre,email FROM  clientes limit ? offset ?;");
            $sentencia->bindParam(1, $limit, PDO::PARAM_INT);
            $sentencia->bindParam(2, $offset, PDO::PARAM_INT);
        }
        $sentencia->execute();
        $clientes = $sentencia->fetchall();  
        $db = null;
    } catch (PDOException $error) {
        echo "Error 103: ". $error->getMessage();
    }
?>