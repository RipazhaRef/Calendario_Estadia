<?php
header("Content-Type: application/json");

/*
INSERT INTO `tbleventos` (`Id`, `title`, `descripcion`, `color`, `start`, `end`) VALUES (NULL, 'Evento 1', 'Develoteca aniversario', '#13ec3e', '2022-09-26 17:27:45', '2022-09-27 00:27:45.000000');
*/

$pdo= new PDO("mysql:host=localhost;dbname=agenda","root","");

$accion=(isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){
    case 'leer':
        $sentenciaSQL= $pdo->prepare("SELECT * FROM tbleventos");
        $sentenciaSQL->execute();

        $resultado=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($resultado));
    break;
    case 'agregar':

        $sentenciaSQL= $pdo->prepare("INSERT INTO `tbleventos` (`Id`, `title`, `descripcion`, `color`, `start`, `end`) VALUES (NULL,:title , :Descripcion , :color , :start, :end);");
        $sentenciaSQL->execute( array(
            "title"=>$_POST['title'],
            "Descripcion"=>$_POST['Descripcion'],
            "color"=>$_POST['color'],
            "start"=>$_POST['Fecha']." ".$_POST['Hora'].":00",
            "end"=>$_POST['Fecha']." ".$_POST['Hora'].":00"
        ));

        print_r($_POST);
    break;
        
}


?>