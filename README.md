# Projeto-HelpDesk
Projeto prático de desenvolvimento de um app que permita abertura de chamados de help desk utilizando PHP puro e estruturado.

## Como 'instalar' o sistema para testes em minha máquina? 
*Levando em consideração a utilização do Windows com Xampp instalado para testes em Localhost. 

1. Coloque a pasta Projeto-HelpDesk em seu htdocs (geralmente localizado em: C:\xampp\htdocs).
2. Coloque a pasta app_help_desk na raíz da pasta Xampp.
3. Pronto, o sistema já pode ser testado. 

##Você talvez se pergunte, por que uma pasta app_help_desk na raíz do Xampp? 
Bom, durante o desenvolvimento do projeto a ideia era de se aproximar um pouco mais do mundo real de programação, mesmo se tratando apenas de um conteúdo básico de PHP. Para tal foram criadas duas pastas em localizações diferentes pois a ideia para elas era: 

1.  app_help_desk
    - Ser o diretório de arquivos/scripts protegidos e sigilosos da aplicação. 
2.  Projeto-HelpDesk
    - Ser o diretório público da aplicação.

##Logins para teste (também podem ser encontrados no script validar_login.php em hardcode):

1. Admin -> E-mail: adm@teste.com.br Senha: 1234
1. Usuário -> E-mail: user@teste.com.br Senha: 1234
1. Maria - Departamento de RH -> E-mail: maria@teste.com.br Senha: 1234
1. José - Departamento Financeiro -> E-mail: jose@teste.com.br Senha: 1234

##Registros já inclusos para teste:

1. 1#Notebook não liga#Hardware#BSOD, 3 pips curtos.
2. 4#Problema na conexão no departamento financeiro.#Rede#Windows exibe o alerta 'Conexão Limitada'
3. 3#Problema na impressora no departamento de RH#Impressora#Imprimindo páginas em branco.

##Regras de negócio do sistema para os utilizadores: 

Maria e José, ambos de seus respectivos departamentos, devem poder abrir chamados de TI, sendo que, cada chamado aberto por tais só poderão ser visualizados por eles mesmos ou pelo usuário/admin (Impossibilitando que José veja os chamados de Maria e vice-versa).

Admin e Usuário devem ser capazes de visualizar todos os chamados de TI realizados por qualquer utilizador do sistema.

##Funcionamento do sistema:

1. valida_login.php
    - Início de sessão com session_start(),
    - Criação de 3 variáveis para controle posterior do script caso o login seja efetuado com sucesso,
    - Array $usuarios_app contendo todos os paramêtros de login em hardcode, 
    - Resgatando o valor preenchido no formulário de login da página index.php com $_POST ($email e $senha),
    - Utilizando a estrutura foreach para recuperar dados do array $usuarios_app e escrever tais em uma array   $user, realizando a comparação com $email e $senha do $_POST para verificar se a array percorrida         corresponde com as informações fornecidas no formulário.
    - Caso corresponda: $usuario_autenticado = true; $usuario_id = $user['id']; $usuario_perfil_id = $user      ['perfil_id'], encaminhando para um if que chega se $usuario_autenticado == true, caso sim, é iniciada    atribuição para a global $_SESSIOn, passando $_SESSION['login'] = 'true'; $_SESSION['id'] = $usuario_id;  $_SESSION['perfil_id'] = $usuario_perfil_id; e direcionando o usuario a página admin.php. Caso não        corresponda: $usuario_autenticado = false, retornando assim a index.php com uma   mensagem de erro no     formulário
