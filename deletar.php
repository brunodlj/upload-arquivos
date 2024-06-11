<?php
$nome_arquivo = $_GET['nome_arquivo'];
$pastaDestino = "/uploads/";
$apagou= unlink( __DIR__ . $pastaDestino . $nome_arquivo);
if($apagou == true){

    $conexao = mysqli_connect("localhost", "root", "", "upload-arquivos");
    $sql= "DELETE FROM arquivo WHERE nome_arquivo='$nome_arquivo'";

    $resultado= mysqli_query($conexao, $sql);
    if($resultado == false){
        echo "Erro ao apagar o arquivo do banco de dados";
        die();
    }
}else{
    echo "Erro ao apagar o arquivo antigo.";
    die();
}
header('location:index.php');