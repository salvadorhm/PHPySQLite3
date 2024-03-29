<?php 
    try {
        session_start();

        $database = $_GET['database'];

        if(isset($database)) {
            $_SESSION["database"] = $database;
        }else{
            if(isset($_SESSION["database"])){
                $database = $_SESSION["database"];
            }else{
                $database = "MySQL";
                $_SESSION["database"] = $database;
            }
        }

        $database = $_SESSION["database"];

        $db=null;

        if($database=="MySQL"){
            $db_host = "localhost";
            $db_username = "administrador";
            $db_password = "123456";
            $db_name = "cllientes";
            $db_port = "3306";
            $db_charset = "utf8";
            $db_collation = "utf8_unicode_ci";
            $db_engine = "InnoDB";

            $db = new PDO("mysql:host=$db_host;dbname=$db_name;port=$db_port;charset=$db_charset;collation=$db_collation", $db_username, $db_password);
        }else if($database=="SQLite"){
            $DB_PATH = $_SERVER['DOCUMENT_ROOT'] . '/sql/clientes.sqlite';
            $db = new PDO('sqlite:' . $DB_PATH);
        }
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    }
    catch (PDOException $error) {
        echo "Error en la conexion: ". $error->getMessage();
    }
?>
