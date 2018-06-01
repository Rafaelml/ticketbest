<?php
/**
 * Created by PhpStorm.
 * User: rmadrigal
 * Date: 16/05/18
 * Time: 11:32
 */
require_once "Conexion_BD_Ticketbest.php";
class Conciertos extends Conexion_BD_Ticketbest
{
    protected $idConcierto;
    protected $idCantante;
    protected $fecha;
    protected $lugar;
    protected $nombre;
    protected function get()
    {

    }

    protected function set()
    {

    }

    protected function update()
    {

    }

    protected function del()
    {

    }
    public function insertarConcierto($name,$fecha,$idCantante,$lugar){
        $this->query ="INSERT INTO `conciertos` (`idConcierto`, `idCantante`, `fecha`, `lugar`, `nombre`) VALUES (NULL, '$idCantante', '$fecha', '$lugar', '$name')";
        $this->execute_single_query();
    }
    public function delConcierto($nombre){
        $this->query ="DELETE FROM `conciertos` WHERE `conciertos`.`nombre` = '$nombre'";
        $this->execute_single_query();
    }
    public function todosConciertos(){
        $this->query ="SELECT * FROM `conciertos`";
        $this->get_results_from_query();
    }

}