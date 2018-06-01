<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 15/5/18
 * Time: 12:38
 */

class Admin extends UserNoR
{
    protected $idUser;
    protected $nick;
    public function construct()
    {
        $this->db_name;
    }
    public function init_Session($nick ='' ,$password=''){
        if(empty($nick) || empty($password)){
            return false;
        }

        $this->query = "SELECT * FROM admin WHERE nick = '$nick'  AND password='$password'";
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $campo =>$valor){
                $this->$campo =$valor;
            }
            $this->createSession();
            return true;
        }
        else{
            return false;
        }
    }
    private function createSession(){
        $tipo = "admin";
        session_start();
        $_SESSION['usuario'] = $this->nick;
        $_SESSION['login'] = true;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['idUser'] = $this->idUser;
        $_SESSION['pulsado'] =false;
    }
    public function viewCantantes(){
        $this->query = "SELECT * FROM `cantantes`";
        $this->get_results_from_query();
        return $this->rows;
    }
    public function viewConciertos(){
        $this->query = "SELECT * FROM `conciertos`";
        $this->get_results_from_query();
        return $this->rows;
    }
    public function viewUsers(){
        $this->query = "SELECT * FROM `UserR`";
        $this->get_results_from_query();
        return $this->rows;
    }
}