<?php
class Primo{
    private $_primo;
    private $_mensaje = "";

    public function __construct($primo){
        $this->_primo = $this->validar($primo);
    }

    private function validar($primo){
        $esprimo = 0;
        if ($primo == 1){
            $this->_mensaje = "El número introducido no es primo";
        }else{
        if ($primo == 2 || $primo == 3 || $primo == 5 || $primo == 7) {
            $this->_mensaje = "El número introducido es primo";
        } else {
            for($b = 1;$b < $primo; $b++){
                if($primo % $b == 0){
                    $esprimo++;
                }
            }
            if($esprimo >= 2 ){
                $this->_mensaje = "El número introducido no es primo";
            } else {
                $this->_mensaje = "El número introducido es primo";
            }
        }
        }
    }

    public function getMensaje(){
        return $this->_mensaje;
    }
}