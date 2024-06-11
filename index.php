<?php
$conexao= mysqli_connect("localhost", "root", "", "upload-arquivos");
$sql= "SELECT * FROM arquivo";
$resultado= mysqli_query($conexao, $sql);
if($resultado != false){
    $arquivos = mysqli_fetch_all($resultado, MYSQLI_BOTH);
}
    else{
        echo "Erro ao executar o comando sql.";
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de arquivos</title>
</head>
<body>
    <form action = "upload.php" method = "post" enctype= "multipart/form-data">
        Adicione o arquivo:
        <input type="file" name="arquivo"><br><br>
        <input type="submit" value="Fazer Upload" name="submit"><br><br>
</form>
    <table>
        <tr> 
            <th> Nome do Arquivo </th>
            <th colspan = "2"> Opções </td>
        </tr>
    <thead>
    <tbody> 
        <?php
        foreach($arquivos as $arquivos){
            $arq = $arquivos['nome_arquivo'];
            echo "<tr>"; //iniciar a linha
            echo "<td>".$arq."</td>"; //primeira coluna com o nome do arquivo 
            echo "<td>"; // iniciar a segunda coluna
            echo "<a "; //abriu o link (abriu a tag <a>)
            echo "href ='alterar.php?nome_arquivo=".$arq."'>";//inseriu o link
            echo "Alterar"; //imprimiu o texto da tag <a>
            echo "</a>"; //fechei o link
            echo "</td>"; // fechei a segunda coluna
            echo "<td>"; //abriu a terceira coluna
            echo "<button ";//abrir o botão
            echo "onclick=";//criou o atributo 'onclick'
            echo "'excluir(\"".$arq. "\");'>"; //chamamos a função excluir
            echo "Excluir"; //mostrar o texto do botão
            echo "</button>"; //fechat a tag button
            echo "</td>"; //fechar a terceira coluna
            echo "</tr>"; //fechar a linha
        }
        ?>
    </tbody>
    </table>
<script> 
function excluir(nome_arquivo){
    let deletar = confirm("Você tem certeza que deseja excluir o arquivo" + nome_arquivo + "?");
    if(deletar == true){
        window.location.href = "deletar.php?nome_arquivo="+ nome_arquivo;
    }
}
</script>
</body>

</html>