<?php

require_once 'cSmap.php';

class cUsuarios extends cSmap {
  
    public function buscaUsuario($user) {

      echo  $this->sql = "buscaUsuario '$user' ";
        return $this->query2();
    }
        public function buscaAcessoUsuario($id_perfil) {

       $this->sql = "buscaAcessoUsuario $id_perfil ";
        return $this->query2();
    }

  
}
