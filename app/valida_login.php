<?php

    session_start();

    //Variável aut
    $usuario_autenticado = false;

    //Usuários do sistema - ainda sem utilizar um banco de dados. 

    $usuarios_app = array(
        array('email' => 'adm@teste.com.br', 'senha' => '123456'),
        array('email' => 'user@teste.com.br', 'senha' => 'abcd')
    );

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    foreach ($usuarios_app as $user) {
        if($user['email'] == $email && $user['senha'] == $senha){
            $usuario_autenticado = true;
            
        }
    }

    if($usuario_autenticado == true){
        $_SESSION['login'] = 'true';
        header('Location: admin.php');
    }else{
        $_SESSION['login'] = 'false';
        header('Location: ../index.php?login=error');
    }

    
?>