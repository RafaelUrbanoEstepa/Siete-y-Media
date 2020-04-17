<?php
include "./class/carta.php";
session_start();
   
$puntosJugador=0;

if (!isset($_SESSION["baraja"])){
    $_SESSION["baraja"]=array();
    for ($i=0; $i < 4; $i++) {
        switch ($i) {
            case 0: 
                array_push($_SESSION["baraja"], array());
                for ($j=1; $j < 11; $j++) { 
                   
                    $palo="basto";
                    $imagen="./src/basto/$j.jpg";
                    $carta = new Carta($j,$palo,$imagen);
                    array_push($_SESSION["baraja"][0], $carta);
                }
                break;
            case 1:
                array_push($_SESSION["baraja"], array());
                for ($j=1; $j < 11; $j++) { 
                    $palo="copa";
                    $imagen="./src/copa/$j.jpg";
                    $carta = new Carta($j,$palo,$imagen);
                    array_push($_SESSION["baraja"][1], $carta);
                }
            break;
            case 2:
                array_push($_SESSION["baraja"], array());
                for ($j=1; $j < 11; $j++) { 
                    $palo="espada";
                    $imagen="./src/espada/$j.jpg";
                    $carta = new Carta($j,$palo,$imagen);
                    array_push($_SESSION["baraja"][2], $carta);
                }
            break;
            case 3:
                array_push($_SESSION["baraja"], array());
                for ($j=1; $j < 11; $j++) { 
                    $palo="oro";
                    $imagen="./src/oro/$j.jpg";
                    $carta = new Carta($j,$palo,$imagen);
                    array_push($_SESSION["baraja"][3], $carta);
                }
            break;
            
            default:
                break;
        }
        
    }    
}


if (!isset($_SESSION["puntosMaquina"])){
    $_SESSION["puntosMaquina"] = 0;
    do {
        $palo=rand(0, 3);
        $numero=rand(0, 9);
    
        $_SESSION["baraja"][$palo][$numero]->setPosicion("maquina");
        $_SESSION["puntosMaquina"] += $_SESSION["baraja"][$palo][$numero]->getValor();
        
    } while ($_SESSION["puntosMaquina"] < 6 && $_SESSION["baraja"][$palo][$numero]->getPosicion() != "baraja");
    
}


function pedirCarta(){
    $palo=rand(0, 3);
    $numero=rand(0, 9);
    if ($_SESSION["baraja"][$palo][$numero]->getPosicion() != "baraja"){
        pedirCarta();
    }else{
       $_SESSION["baraja"][$palo][$numero]->setPosicion("jugador"); 
    }
}

if (isset($_POST["pedir"])){
    pedirCarta();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de las Siete y Media Rafael Urbano Estepa</title>
</head>
<body>
    <h1>Juego de las Siete y Media Rafael Urbano Estepa</h1>

    <fieldset>
    <?php
    foreach ($_SESSION["baraja"] as $palo => $cartas) {
        foreach ($cartas as $carta) {
            if ($carta->getPosicion()== "jugador") {
                $puntosJugador +=$carta->getValor();
                echo"<img src=\"".$carta->getImagen()."\" alt=\"carta\">";
            }
        }
    }       
    
    echo "<br>";
    echo "<h3>Tienes tiene un total de ".$puntosJugador." puntos</h3>";
    
    if (isset($_POST["revelar"])){
        foreach ($_SESSION["baraja"] as $palo => $cartas) {
            foreach ($cartas as $carta) {
                if ($carta->getPosicion()== "maquina") {
                    echo"<img src=\"".$carta->getImagen()."\" alt=\"carta\">";
                }
            }
        }      

        echo "<h3>La banca tiene un total de ".$_SESSION["puntosMaquina"]." puntos</h3>";
        if ($_SESSION["puntosMaquina"] < $puntosJugador && $puntosJugador <=7.5 || $_SESSION["puntosMaquina"] > 7.5 && $puntosJugador <= 7.5) {
            echo "<h1>Enhorabuena, ha ganado</h1>";
        }else if($_SESSION["puntosMaquina"] > 7.5 || $_SESSION["puntosMaquina"] < $puntosJugador){
            echo "<h1>Empate</h1>";
        }else{
            echo "<h1>Lo siento, la banca gana</h1>";
        }
        echo "<hr>";
    }
    
    ?>
    <form action="index.php" method="post">
    <input type="submit" name="pedir" value="Pedir carta">
    </form>
    <hr>
    <form action="index.php" method="post">
    <input type="submit" name="revelar" value="Plantarse">
    </form>
    </fieldset>

<a href="cierraSesiones.php">Reiniciar Juego</a>
</body>
</html>
