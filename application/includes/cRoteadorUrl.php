<?php

class cRoteadorUrl {

    protected $uri = array();
    protected $modulo;
    protected $pagina;
    protected $p1;
    protected $p2;
    protected $p3;
    protected $p4;
    protected $p5;
    protected $p6;
    protected $URL = array();

    public function __construct() {
        $this->parametros();
    }


    public function parametros() {

        // r e a variavel get da url, capturada pelo arquivo .htaccess
        @$GET = $_GET['r'];
        //var_dump($GET);exit;
        $this->uri = ( isset($GET) ) ? explode('/', $GET) : array('');
    }

    public function parametro($key) {
        if (array_key_exists($key, $this->uri)) {
            return $this->uri[$key];
        } else {
            return false;
        }
    }

    public function modulo() {
        $this->modulo = ( $this->uri[0] == NULL ) ? 'login' : $this->uri[0];

        return ( is_string($this->modulo) ) ? $this->modulo : 'login';
    }

    public function pagina() {
        $this->pagina = (
                isset($this->uri[1]) && strlen($this->uri[1]) != 0 && is_string($this->uri[1])
                ) ? $this->uri[1] : 'inicio';

        return $this->pagina;
    }

    public function p1() {
        $this->p1 = (
                isset($this->uri[2]) && strlen($this->uri[2]) != 0 && is_string($this->uri[2])
                ) ? $this->uri[2] : 'inicio';

        return $this->p1;
    }

    public function p2() {
        $this->p2 = (
                isset($this->uri[3]) && strlen($this->uri[3]) != 0 && is_string($this->uri[3])
                ) ? $this->uri[3] : 'inicio';

        return $this->p2;
    }

    public function p3() {
        $this->p3 = (
                isset($this->uri[4]) && strlen($this->uri[4]) != 0 && is_string($this->uri[4])
                ) ? $this->uri[4] : 'inicio';

        return $this->p3;
    }

    public function p4() {
        $this->p4 = (
                isset($this->uri[5]) && strlen($this->uri[5]) != 0 && is_string($this->uri[5])
                ) ? $this->uri[5] : 'inicio';

        return $this->p4;
    }

    public function p5() {
        $this->p5 = (
                isset($this->uri[6]) && strlen($this->uri[6]) != 0 && is_string($this->uri[6])
                ) ? $this->uri[6] : 'inicio';

        return $this->p5;
    }

    public function p6() {
        $this->p6 = (
                isset($this->uri[7]) && strlen($this->uri[7]) != 0 && is_string($this->uri[7])
                ) ? $this->uri[7] : 'inicio';

        return $this->p6;
    }

}

?>
