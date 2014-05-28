<?php
class Usuario {
//put your code here
    protected static $listaPermissao = array("ADMINISTRADOR","CONTRATTE","BORSARI","ESPECTADOR");
    private $id;
    private $login;
    private $senha;
    private $nome;
    private $permissao;
    private $setor;

    public static function empacotaUsuarioPorResultSet($resultSet) {
        $u = new Usuario();
        $u->setLogin($resultSet['login']);
        $u->setSenha($resultSet['senha']);
        $u->setNome($resultSet['nome']);
        $u->setPermissao($resultSet['permissao']);
        $u->setSetor($resultSet['setor']);
        $u->setId($resultSet['id']);
        return $u;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }
                                       
    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function getSetor() {
        return $this->setor;
    }                                  
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPermissao() {
        return $this->permissao;
    }

    public function setPermissao($permissao) {
        $this->permissao = $permissao;
    }




    public function getPermissaoTexto() {
        switch ($this->getPermissao()) {
            case 0:return "ADMINISTRADOR";
                break;
            case 1:return "CONTRATTE";
                break;
            case 2:return "BORSARI";
                break;
            case 4:return "ESPECTADOR";
                break;
            default: return false;
        }
    }



}    
?>
