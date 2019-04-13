<?php

    session_start();

    //Variável aut
    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_perfil_id = null;

    $perfis = array(1 => 'Administrativo', 2 => 'Usuário');
    //Usuários do sistema - ainda sem utilizar um banco de dados. 

    $usuarios_app = array(
        array('id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
        array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
        array('id' => 3, 'email' => 'maria@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
        array('id' => 4, 'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil_id' => 2)
    );

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    foreach ($usuarios_app as $user) {
        if($user['email'] == $email && $user['senha'] == $senha){
            $usuario_autenticado = true;
            $usuario_id = $user['id'];
            $usuario_perfil_id = $user['perfil_id'];
        }
    }

    if($usuario_autenticado == true){
        $_SESSION['login'] = 'true';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil_id'] = $usuario_perfil_id;
        header('Location: admin.php');
    }else{
        $_SESSION['login'] = 'false';
        header('Location: ../index.php?login=error');
    }

    
?>