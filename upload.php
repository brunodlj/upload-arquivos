<?php
$pastaDestino = "/uploads/";

if ($_FILES['arquivo']['size'] > 2000000){
    echo "O tamanho do arquivo é maior que o limite permitido.";
    die();
}

$extensao= strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));

if($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "gif" && $extensao != "jfif" && $extensao != "svg"){
    echo "O arquivo não é uma imagem! Apenas selecione arquivos com extensão png, jpg, jpeg, gif, jfif ou svg";
    die();
}
if(getimagesize($_FILES['arquivo']['tmp_name']) === false){
    echo "Problemas ao enviar a imagem! Tente novamente.";
    die();
}

$nomeArquivo = uniqid();
$fezUpload = move_uploaded_file($_FILES['arquivo']['tmp_name'], __DIR__ . $pastaDestino . $nomeArquivo . ".". $extensao);
if($fezUpload == true){

    $conexao = mysqli_connect("localhost", "root", "", "upload-arquivos");
    $sql= "INSERT INTO arquivo (nome_arquivo) VALUES ('$nomeArquivo.$extensao')";
    $resultado = mysqli_query($conexao, $sql);
    if($resultado != false)
    {
        if(isset($_POST['nome_arquivo']) ){
            $apagou= unlink( __DIR__ . $pastaDestino . $_POST['nome_arquivo']);
            if($apagou == true){
                $sql= "DELETE FROM arquivo WHERE nome_arquivo='".$_POST['nome_arquivo']."'";
                
                $resultado2= mysqli_query($conexao, $sql);
                if($resultado2 == false){
                    echo "Erro ao apagar o arquivo do banco de dados";
                    die();
                }
            }else{
                echo "Erro ao apagar o arquivo antigo.";
                die();
            }
        }
    header("location: index.php");
    } 
    else 
    {
        echo "Erro ao registrar o arquivo no banco";
    }

}
else {
    echo "Erro ao mover o arquivo";
}