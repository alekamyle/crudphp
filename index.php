<?php
require_once('classes/Crud.php');
require_once('conexao/conexao.php');

$database = new database();
$db = $database->getConnection();
$crud = new crud($db);

if(isset($_GET['action'])){
    switch($_GET['action']){
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read();
            break;
        case 'read';
            $rows = $crud->read();
            break;
        //case update
        
        //case delete

        default:
            $rows = $crud->read();
            break;
    }
}else{
    $rows = $crud->read();
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
</head>
<body>
  <style>
        form{
            max-width:500px;
            margin: 0 auto;
        }
         label{
            display: flex;
            margin-top:10px
         }
         input[type=text]{
            width:100%;
            padding: 12px 20px;
            margin: 8px 0;
            display:inline-block;
            border: 1px solid #ccc;
            border-radius:4px;
            box-sizing:border-box;
         }
         input[type=submit]{
            background-color:#4caf50;
            color:white;
            padding:12px 20px;
            border:none;
            border-radius:4px;
            cursor:pointer;
            float:right;
         }
         input[type=submit]:hover{
            background-color:#45a049;
         }
         table{
            border-collapse:collapse;
            width:100%;
            font-family:Arial, sans-serif;
            font-size:14px;
            color:#333;
         }
         th, td{
            text-align:left;
            padding:8px;
            border: 1px solid #ddd;
         }
        th{
           background-color:#f2f2f2;
           font-weight:bold; 
        }
        a{
            display:inline-block;
            padding:4px 8px;
            background-color: #007bff;
            color:#fff;
            text-decoration:none;
            border-radius:4px;
        }
        a:hover{
            background-color:#0069d9;
        }

        a.delete{
            background-color: #dc3545;
        }
        a.delete:hover{
            background-color:#c82333;
        }
    </style>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
</head>
<body>

 <?php
    if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])){
        $id = $_GET['id'];
        $result =$crud->readOne($id);

if($result){
    echo "Registo não encontrado.";
    exit();
}
$modelo = $result['modelo'];
$marca = $result['marca'];
$placa = $result['placa'];
$cor = $result['cor'];
$ano = $result['ano'];


 ?>

    <form action="?action=create" method="POST">
        <label for="">modelo</label>
         <input type="text" name="modelo">

         
        <label for="">marca</label>
        <input type="text" name="marca">

         
        <label for="">placa</label>
         <input type="text" name="placa">

         
        <label for="">cor</label>
         <input type="text" name="cor">

         
        <label for="">ano</label>
         <input type="text" name="ano">

         <input type="submit" value="cadastrar" name="enviar"></input>
    </form>
    <table>
        <tr>
            <td>id</td>
            <td>modelo</td>
            <td>marca</td>
            <td>placa</td>
            <td>cor</td>
            <td>ano</td>
            <td>acoes</td>
        </tr>

        <?php

        if(isset($rows)){
            foreach($rows as $row){
                echo "<tr>";
                echo "<td>". $row['id']."</td>";
                echo "<td>". $row['modelo']."</td>";
                echo "<td>". $row['marca']."</td>";
                echo "<td>". $row['placa']."</td>";
                echo "<td>". $row['cor']."</td>";
                echo "<td>". $row['ano']."</td>";
                echo "<td>";
                echo "<a href='?action=update&id=" .$row ['id']."'>editsr</a>";
                echo "<a href='?action=update&id=" .$row ['id']."'onclick=' return confirm(\"tem certeza que deseja deletar esse registro?\")' class = 'delete'>Deletar</a>";
                echo "</td>";
                echo "</tr>";

            }
        }else{
            echo "nao ha registro a serem exibidos";
        }

        ?>

    </table>

</body>
</html>