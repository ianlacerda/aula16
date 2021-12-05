<?php 

$idvendedor = isset($_GET["idvendedor"]) ? $_GET["idvendedor"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendedores where idvendedor=:idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            header("Location:listarvendedores.php");
        }


        if($idvendedor){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  vendedores where idvendedor=:idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            $vendedor = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($vendedor);
        }
        if($_POST){
            if($_POST["idvendedor"]){
                $sql = "UPDATE vendedores SET nome=:nome, dataadmissao=:dataadmissao, salario=:salario WHERE idvendedor=:idvendedor";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome", $_POST["nome"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendedores(nome,dataadmissao,salario) VALUES (:nome,:dataadmissao,:salario)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome", $_POST["nome"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
                $stmt->execute(); 
            }
            header("Location:listarvendedores.php");
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
<h1>Cadastro de Vendedores</h1>
<form method="POST">
nome  <input type="text" name="nome"        value="<?php echo isset($vendedor) ? $vendedor->nome : null ?>"><br>

data de admissão <input type="date" name="dataadmissao"       value="<?php echo isset($vendedor) ? $vendedor->dataadmissao : null ?>"><br>

salario <input type="text" name="salario"       value="<?php echo isset($vendedor) ? $vendedor->salario : null ?>"><br>

<input type="hidden"     name="idvendedor"   value="<?php echo isset($vendedor) ? $vendedor->idvendedor : null ?>">
<input type="submit">
</form>
<a href="listarvendedores.php">volta</a>
</body>
</html>