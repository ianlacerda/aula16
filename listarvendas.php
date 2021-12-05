<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendas";
    $qry = $con->query($sql);
    $vendas = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($vendas);
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
    
<h1>Lista de Vendas</h1>
<hr>
<a href="frmvenda.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>ID Venda</th> 
           <th>ID Vendedor</th>
           <th>ID Produto</th>
           <th>Quantidade</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendas as $venda_op) { ?>
        <tr>
            <td><?php echo $venda_op->idvendas ?></td>
            <td><?php echo $venda_op->idvendedor ?></td>
            <td><?php echo $venda_op->idproduto ?></td>
            <td><?php echo $venda_op->qtd ?></td>
            <td><a href="frmvenda.php?idvendas=<?php echo $venda_op->idvendas ?>">Editar</a></td>
            <td><a href="frmvenda.php?op=del&idvendas=<?php echo  $venda_op->idvendas ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>