<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendedores";
    $qry = $con->query($sql);
    $vendedores = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($vendedores);
    //die();
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Lista de Vendedores</h1>
<hr>
<a href="frmvendedor.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>ID Vendedor</th> 
           <th>Nome</th>
           <th>Data de Admissão</th>
           <th>Salário</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendedores as $vendedor) { ?>
        <tr>
            <td><?php echo $vendedor->idvendedor ?></td>
            <td><?php echo $vendedor->nome ?></td>
            <td><?php echo $vendedor->dataadmissao ?></td>
            <td><?php echo $vendedor->salario ?></td>
            <td><a href="frmvendedor.php?idvendedor=<?php echo $vendedor->idvendedor ?>">Editar</a></td>
            <td><a href="frmvendedor.php?op=del&idvendedor=<?php echo  $vendedor->idvendedor ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>