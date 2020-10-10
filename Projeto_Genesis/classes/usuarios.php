<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";//se vazio tudo ok

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try
        {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,
            $usuario,$senha);
        } catch(PDOException $e){
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $funcao_cargo, $usuario, $senha)
    {
        global $pdo;
        //verificar se já existe um usuario cadastrado
        $sql = $pdo->prepare("SELECT ID FROM USUARIOS WHERE usuario = :u");
        $sql->bindValue(":u",$usuario);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false;//já esta cadastrada
        } else{
        //caso não, cadastrar
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, funcao_cargo, usuario, senha) VALUES (:n, :f, :u, :s)");
        $sql->bindValue(":n",$nome);
        $sql->bindValue(":f",$funcao_cargo);
        $sql->bindValue(":u",$usuario);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        return true;
        }
    }

    public function logar($usuario, $senha)
    {
        global $pdo;
        //verifica se o e-mail e senha estao cadastrados, se sim
        $sql = $pdo->prepare("SELECT ID FROM usuarios where usuarios = :u AND senha = :s");
        $sql->bindValue(":u",$usuario);
        $senha = md5($senha);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
            if($sql->rowCount() > 0){
                //entrar no sistema
                $dado = $sql->apc_fetch();
                session_start();
                $_SESSION['ID_USUARIO'] = $dado['id'];
                return true;//logado com sucesso
        }else{
            return false;//não foi possivel logar
        }
    }

}
?>