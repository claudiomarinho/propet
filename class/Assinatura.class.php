<?php

class Assinatura {

    private $vPermissao;

    public function validaSession() {

        if (isset($_SESSION['NO_LOGIN']) && (strlen($_SESSION['NO_LOGIN']) > 0)) {
            if (is_null($this->vPermissao) || in_array($_SESSION["CO_PERFIL"], $this->vPermissao)) {
                return true;
            } else {
                header('location: logout.php?denied=true');
                exit;
                return false;
            }
        } else {
            $_SESSION = array();
            unset($_SESSION);
            session_destroy();
            header('Location: logout.php');
            exit;
            return false;
        }
    }

    public function setValidaSession($vPermissao = null) {
        $this->vPermissao = $vPermissao;
        return $this->validaSession();
    }

}

?>