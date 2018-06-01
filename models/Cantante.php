<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 15/5/18
 * Time: 14:10
 */
require_once ("UserNoR.php");
class Cantante extends UserNoR
{
    private $idCantante;
    private $Nombre;
    public function construct()
    {
        $this->db_name;
    }
    public function insertarCantante($nombre){
        $this->query ="INSERT INTO `cantantes` (`idCantante`, `nombre_completo`) VALUES (NULL, '$nombre');";
        $this->execute_single_query();
    }
    public function delCantante($nombre){
        $this->query ="DELETE FROM `cantantes` WHERE `cantantes`.`nombre_completo` = '$nombre'";
        $this->execute_single_query();
    }
    public function obtenerCantantes(){
        $this->query ="SELECT * FROM `cantantes`";
        $this->get_results_from_query();
    }
    public function obtenerCantantesconSeguidores(){
        $this->query ="SELECT * FROM `cantantes`";
        $this->get_results_from_query();
    }
    public function getIdUser($nick ="")
    {
        if ($nick != "") {
            $this->query = "SELECT idCantante FROM cantantes WHERE nombre_completo ='$nick'";
            $this->get_results_from_query();
            $this->idCantante =array_pop($this->rows)["idCantante"];
        }
        return $this->idCantante;
    }
    public function getNick($idUser)
    {
        if ($idUser != "") {
            $this->query = "SELECT nombre_completo FROM cantantes WHERE idCantante ='$idUser'";
            $this->get_results_from_query();
            $this->nombre_completo =array_pop($this->rows)["nombre_completo"];
        }
        return $this->nombre_completo;
    }
}