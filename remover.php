<?php
    $id = $_GET['id'];
    
    if(filter_var($id, FILTER_VALIDATE_INT)) {

        include_once("./conexao/conexao.php");

        try {
            $queryFoto = "SELECT foto FROM usuario WHERE id = :id";
            $stmt = $connection->prepare($queryFoto);
            $stmt->bindValue(':id', $id);
            $stmt->execute(); 
            $foto = $stmt->fetch();
            $deleteFoto = unlink($foto['foto']);
                
            $queryDeleteUsuario = "DELETE FROM usuario WHERE id = :id";
            $stmt = $connection->prepare($queryDeleteUsuario);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            echo "<script>alert('Registro excluído com sucesso!');</script>";
            echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";

        } catch(PDOException $e) {
            $erro = $e->getMessage();
        }
    }
?>