<?php 

$idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendas where idvendas=:idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if($idvendas){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  vendas where idvendas=:idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            $vendedor = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($vendedor);
        }
        if($_POST){
            if($_POST["idvendas"]){
                $sql = "UPDATE vendas SET idvendedor=:idvendedor, idproduto=:idproduto, qtd=:qtd WHERE idvendas=:idvendas";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":qtd", $_POST["qtd"]);
                $stmt->bindValue(":idvendas", $_POST["idvendas"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendas(idvendedor,idproduto,qtd) VALUES (:idvendedor,:idproduto,:qtd)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":qtd", $_POST["qtd"]);
                $stmt->execute(); 
            }
            header("Location:listarvendas.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Cadastro de Vendas</h1>
<form method="POST">
ID Vendedor  <input type="number" name="idvendedor"        value="<?php echo isset($vendedor) ? $vendedor->idvendedor : null ?>"><br>

ID Produto <input type="number" name="idproduto"       value="<?php echo isset($vendedor) ? $vendedor->idproduto : null ?>"><br>

Quantidade <input type="number" name="qtd"       value="<?php echo isset($vendedor) ? $vendedor->qtd : null ?>"><br>

<input type="hidden"     name="idvendas"   value="<?php echo isset($vendedor) ? $vendedor->idvendas : null ?>">
<input type="submit">
</form>
<a href="listarvendas.php">volta</a>
</body>
</html>