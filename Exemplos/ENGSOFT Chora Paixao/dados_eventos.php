 <?php
 
 class Evento {

    private $id;
    private $usuario;
    private $evento;
    private $idAlteracao;
    private $data;
    private $valor;

    public static function empacotarEventoPorResultSet($resultSet) {
        $evento = new Evento();
        $gab = new GAB();
        $evento->setId($resultSet['id']);

        $usuario = new Usuario();
        $usuario->setId($resultSet['usuario']);
        $evento->setUsuario($gab->buscarUsuario($usuario));
        $evento->setEvento($resultSet['evento']);

        $evento->setIdAlteracao($resultSet['idAlteracao']);
        $evento->setValor($resultSet['valor']);
        $evento->setData($resultSet['data']);

        return $evento;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }


    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getEvento() {
        return $this->evento;
    }

    public function getIdAlteracao() {
        return $this->idAlteracao;
    }

    public function getData() {
        return $this->data;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setEvento($evento) {
        if(is_numeric($evento)) {
            $this->evento = $evento;
        }else {
            switch ($evento) {
                case "":                    $this->evento = 0;
                    break;
                case "ERRO":                $this->evento = 1;
                    break;
                case "LOGIN":               $this->evento = 2;
                    break;
                case "LOGOFF":              $this->evento = 3;
                    break;

                case "CADASTRAR_USUARIO":   $this->evento = 4;
                    break;
                case "ALTERAR_USUARIO":     $this->evento = 5;
                    break;
                case "CONSULTAR_USUARIO":   $this->evento = 6;
                    break;
                case "EXCLUIR_USUARIO":     $this->evento = 7;
                    break;

                case "CADASTRAR_IMOVEL":    $this->evento = 8;
                    break;
                case "ALTERAR_IMOVEL":      $this->evento = 9;
                    break;
                case "CONSULTAR_IMOVEL":    $this->evento = 10;
                    break;
                case "EXCLUIR_IMOVEL":      $this->evento = 11;
                    break;

                case "CADASTRAR_SERVICO":   $this->evento = 12;
                    break;
                case "ALTERAR_SERVICO":     $this->evento = 13;
                    break;
                case "CONSULTAR_SERVICO":   $this->evento = 14;
                    break;
                case "EXCLUIR_SERVICO":     $this->evento = 15;
                    break;

                default:$this->evento = 0;
            }
        }
    }

    public function getEventoTexto() {
        $texto="";
        switch ($this->getEvento()) {
            case 0: $texto =  "";
                break;
            case 1: $texto =  "ERRO";
                break;
            case 2: $texto =  "LOGIN";
                break;
            case 3: $texto =  "LOGOFF";
                break;
            case 4: $texto =  "CADASTRAR USUARIO";
                break;
            case 5: $texto =  "ALTERAR USUARIO";
                break;
            case 6: $texto =  "CONSULTAR USUARIO";
                break;
            case 7: $texto =  "EXCLUIR USUARIO";
                break;
            case 8: $texto =  "CADASTRAR IMOVEL";
                break;
            case 9: $texto =  "ALTERAR IMOVEL";
                break;
            case 10: $texto =  "CONSULTAR IMOVEL";
                break;
            case 11: $texto =  "EXCLUIR IMOVEL";
                break;
            case 12: $texto =  "CADASTRAR SERVICO";
                break;
            case 13: $texto =  "ALTERAR SERVICO";
                break;
            case 14: $texto =  "CONSULTAR SERVICO";
                break;
            case 15: $texto =  "EXCLUIR SERVICO";
                break;
        }
        return $texto;
    }

    public function setIdAlteracao($idAlteracao) {
        $this->idAlteracao = $idAlteracao;
    }

    public function setData($data) {
        $this->data = $data;
    }


    public static function getListaDeEventos() {
        return $lista;
    }
}
?>
