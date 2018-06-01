<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 11/4/18
 * Time: 17:39
 */

abstract class Conexion_BD_Ticketbest
{
    private static $db_host ="localhost";
    private static $db_user ="root";
    private static $db_password ="";
    private $conexion;
    protected $db_name ="ticketbest";
    protected $query;
    protected $rows =array();

    abstract protected function get();
    abstract protected function set();
    abstract protected function update();
    abstract protected function del();

    public function open_connection(){
        $this ->conexion = new mysqli(self::$db_host, self::$db_user, self::$db_password ,$this ->db_name);
    }
    function close_conection(){
        $this->conexion->close();
    }

    protected function execute_single_query(){
        $this->open_connection();
        $this->conexion->query($this->query);
        $this->close_conection();
    }
    protected function get_results_from_query(){
        $this->open_connection();
        $result =$this->conexion->query($this->query);
        while ($this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->close_conection();
        array_pop($this->rows);
    }

}
?>