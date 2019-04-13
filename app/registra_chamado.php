<?php

    session_start();

    $titulo         = str_replace('#', '-', $_POST['titulo']);
    $categoria      = str_replace('#', '-', $_POST['categoria']);
    $descricao      = str_replace('#', '-', $_POST['descricao']);

    $chamado = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;

    //Abrindo o arquivo
    $arquivo = fopen('../../../app_help_desk/arquivo.bd', 'a');
    
    //Escrevendo o texto
    fwrite($arquivo, $chamado);

    //Fechando o arquivo
    fclose($arquivo);

    header('Location: abrir_chamado.php');

?>