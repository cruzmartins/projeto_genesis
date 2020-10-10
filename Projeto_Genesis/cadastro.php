<?php
    require_once 'classes/usuarios.php';
    $u = new Usuario;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body><center>
    <div id="formulario">
    <h1>Cadastrar Usuário</h1>
        <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
        <input type="text" name="funcao_cargo" placeholder="Função/Cargo" maxlength="30">
        <input type="text" name="usuario" placeholder="Usuário" maxlength="30">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="conf_senha" placeholder="Confirmar Senha">
        <input type="submit" value="Cadastrar">
        


    </form>
</div>
</center>
<?php
//verificar se clicou no botao
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $funcao_cargo = addslashes($_POST['funcao_cargo']);
    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);
    $conf_senha = addslashes($_POST['conf_senha']);
    //verificar se esta preenchido
    if(!empty($nome) && !empty($funcao_cargo) &&!empty($usuario) && !empty($senha) && !empty($conf_senha))
        {
            $u->conectar("projeto_login", "localhost", "root", "");
            if($u->msgErro == ""){
                if($senha == $conf_senha){
                    if($u->Cadastrar($nome, $funcao_cargo, $usuario, $senha))
                    {
                        echo"Cadastrado com sucesso!";
                    }else{
                        echo"Usuário já cadastrado";
                    }
                }else "As senha não estão iguais";
                
            }else{
                echo "Erro: ".$u->msgErro;
            }

        }else
        {
            echo"Preencha todos os campos!";
        }

}
?>
</body>
</html>