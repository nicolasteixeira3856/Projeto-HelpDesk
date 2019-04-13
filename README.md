# Projeto-HelpDesk

Projeto prático de desenvolvimento de um app que permita abertura de chamados de help desk utilizando PHP puro, básico/intermediário e estruturado.

## Como 'instalar' o sistema para testes em minha máquina? 
*Levando em consideração a utilização do Windows com Xampp instalado para testes em Localhost. 

1. Coloque a pasta Projeto-HelpDesk em seu htdocs (geralmente localizado em: C:\xampp\htdocs).
2. Coloque a pasta app_help_desk na raíz da pasta Xampp.
3. Pronto, o sistema já pode ser testado. 

## Você talvez se pergunte, por que uma pasta app_help_desk na raíz do Xampp?

Bom, durante o desenvolvimento do projeto a ideia era de se aproximar um pouco mais do mundo real de programação, mesmo se tratando apenas de um conteúdo básico de PHP. Para tal foram criadas duas pastas em localizações diferentes pois a ideia para elas era: 

1.  app_help_desk:
    - Ser o diretório de arquivos/scripts protegidos e sigilosos da aplicação. 
2.  Projeto-HelpDesk:
    - Ser o diretório público da aplicação.

## Logins para teste (também podem ser encontrados no script validar_login.php em hardcode):

1. Admin -> E-mail: adm@teste.com.br Senha: 1234
1. Usuário -> E-mail: user@teste.com.br Senha: 1234
1. Maria - Departamento de RH -> E-mail: maria@teste.com.br Senha: 1234
1. José - Departamento Financeiro -> E-mail: jose@teste.com.br Senha: 1234

## Registros já inclusos para teste:

1. 1#Notebook não liga#Hardware#BSOD, 3 pips curtos
2. 4#Problema na conexão no departamento financeiro.#Rede#Windows exibe o alerta 'Conexão Limitada'
3. 3#Problema na impressora no departamento de RH#Impressora#Imprimindo páginas em branco

## Regras de negócio para o sistema: 

Maria e José, ambos de seus respectivos departamentos, devem poder abrir chamados de TI, sendo que, cada chamado aberto por tais só poderão ser visualizados por eles mesmos ou pelo usuário/admin (Impossibilitando que José veja os chamados de Maria e vice-versa).

Admin e Usuário devem ser capazes de visualizar todos os chamados de TI realizados por qualquer utilizador do sistema.

## Funcionamento do sistema:

1. valida_login.php
    - Início de sessão com session_start(),
    - Criação de 3 variáveis para controle posterior do script caso o login seja efetuado com sucesso,
    - Array $usuarios_app contendo todos os paramêtros de login em hardcode, 
    - Resgatando o valor preenchido no formulário de login da página index.php com $_POST ($email e $senha),
    - Utilizando a estrutura foreach para recuperar dados do array $usuarios_app e escrever tais em uma array   $user, realizando a comparação com $email e $senha do $_POST para verificar se a array percorrida         corresponde com as informações fornecidas no formulário,
    - Caso corresponda: $usuario_autenticado = true; $usuario_id = $user['id']; $usuario_perfil_id = $user      ['perfil_id'], encaminhando para um if que chega se $usuario_autenticado == true, caso sim, é iniciada    atribuição para a global $_SESSIOn, passando $_SESSION['login'] = 'true'; $_SESSION['id'] = $usuario_id;  $_SESSION['perfil_id'] = $usuario_perfil_id; e direcionando o usuario a página admin.php. Caso não        corresponda: $usuario_autenticado = false, retornando assim a index.php com uma   mensagem de erro no     formulário.
2. admin.php
    - Página simples que encaminha para dois scripts diferentes: abrir_chamado.php ->    registra_chamado.php (script) e consultar_chamado.php.
3. abrir_chamado.php -> registra_chamado.php
    - Formulário simples contendo 3 campos: título, categoria e descrição que            encaminha com método post para registra_chamado.php,
    - Início de sessão com session_start(),
    - Variáveis $titulo, $categoria e $descricao que recebem via $_POST seus             respectivos valores,
    - É utilizado um str_replace de # para - caso o usuário utilize # na criação de      chamados, buscando evitar o não funcionamento do sistema,
    - É aberto um arquivo fopen('../../../app_help_desk/arquivo.bd', 'a') para           inserção dos registros,
    - Logo em seguida é realizada a inserção dos registros de fato fwrite($arquivo,      $chamado);,
    - fclose($arquivo) - importante lembrar de sempre fechar o arquivo após manipular.
    - Header direcionando o usário novamente a abrir_chamado.php.
4. consultar_chamado.php
    - Criação de uma variável $chamados como array,
    - Executado a abertura do arquivo.bd com fopen(),
    - Utilizado uma estrutura de repetição while com um feof (end of file) com uma       negação, utilizando as variáveis dentro do while $registro = fgets($arquivo);
      $chamados[] = $registro;,
    - fclose($arquivo) - importante lembrar de sempre fechar o arquivo após manipular,
    - Na < div class="card-body" > (onde os registros são listados) é utilizado um       foreach $chamados as $chamado, logo em seguida é executado um explode buscando     por '#' (aqui a importância de filtrar tal caso o usuário insira) de $chamado, 
    - Condição para verificar se a pessoa acessando a página é um usuário, se sim é      executado uma outra condição que possui como parâmetro $_SESSION['id'], essa que   por sua vez ignora os dados que não foram preenchidos pelo usuário da id em        questão,
    - Realizando um count do array $chamado_dados para verificar a linha vazia do        arquivo.bd e desconsiderar tal,
    - Impressão dos dados em seus respectivos campos e logo após a finalização da        abertura do php,

## Considerações finais

O desenvolvimento desse projeto foi de grande relavância para mim como desenvolvedor, onde busquei (por opção própria) me limitar de recursos adicionais, optando sempre por funções mais básicas do PHP para algo trivial como criação e leitura de dados, além da proteção de páginas por session, atribuição de niveís e diferentes ID's para cada usuário. 
