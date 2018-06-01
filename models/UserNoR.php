<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 11/4/18
 * Time: 17:30
 */
require_once "Conexion_BD_Ticketbest.php";
class UserNoR extends Conexion_BD_Ticketbest
{
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
    private  function  init($idUser = "")
    {
        /*$nick="";
        if ($idUser != "") {
            $this->query = "SELECT nick FROM userr WHERE idUser ='$idUser'";
            $this->get_results_from_query();
            $nick = array_pop($this->rows);
        }
        if(isset($nick['nick'])){
            return $nick['nick'];
        }*/
    }
    public static function closeSession(){
        session_start();
        $_SESSION = array();
        session_destroy();
    }
    public function view2Cantantes(){
        $this->query = "SELECT * FROM `cantantes`  ORDER BY `cantantes`.`followers` DESC";
        $this->get_results_from_query();
        return $this->rows;
    }
}
?>
