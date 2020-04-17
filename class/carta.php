<?php
class Carta{
    private $_numero;
    private $_palo;
    private $_imagen;
    private $_posicion;
    private $_mensaje = "";

    public function __construct($numero,$palo,$imagen){
        $this->_numero = $numero;
        $this->_palo = $palo;
        $this->_imagen = $imagen;
        $this->_posicion = "baraja";
    }

   
    public function getValor(){
        if ($this->_numero > 7) {
            return 0.5;
        }else{
            return $this->_numero;   
        }
        
    }

    public function getPalo(){
        return $this->_palo;
    }

    public function getPosicion(){
        return $this->_posicion;
    }

    public function setPosicion($lado){
        $this->_posicion = $lado;
    }
    
    public function getImagen(){
        return $this->_imagen;
    }

    public function getMensaje(){
        return $this->_mensaje;
    }
}