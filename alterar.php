<?php
$nome_arquivo= $_GET['nome_arquivo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Arquivo </title>
</head>
<body>
    <form action = "upload.php" method = "post" enctype= "multipart/form-data">
        Alterando o arquivo <?=$nome_arquivo ?>:<br>
        <input  type = "hidden" value="<?=$nome_arquivo?>" name="nome_arquivo">
        <input type="file" name="arquivo"><br><br>
        <input type="submit" value="Alterar" name="submit"><br><br>
    </form>
</body>
</html>