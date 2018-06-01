<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 20/4/18
 * Time: 18:39
 */

require_once  '../models/Conciertos.php';
require_once  '../models/UserR.php';
require_once '../models/Admin.php';
require_once '../models/Cantante.php';
class Controller{
    private $user;
    public function construct()
    {
        $this->user = new UserNoR();
    }

    public function actFollowing($idUser ,$name){
        $cantante =new Cantante();
        $name =$cantante->getIdUser($name);
        $this->user =new UserR();
        if(!$this->user->existFollowing($idUser,$name)){
            $this->user->addFollowings($idUser,$name);
        }
        else{
        $this->user->delFollowing($idUser, $name);
        }
        header('Location: ../views/contenedor.php?$opcion=vercantantes');

    }

    public static function cargarWeb(){
        //require_once ("../viewss/inicio.php");
        header("Location: views/inicio.php");
    }
    public function registr($user_data = array())
    {
        $this->user = new UserR();
        $idUser = $this->user->getIdUser($user_data['nick']);
        $email = $this->user->checkEmail($user_data['email']);
        if(substr($user_data['nick'], 0, 5) =='admin'){
            echo 'La palabra admin al inicio del usuario está reservada para los administradores.';
            echo 'Por favor pruebe con otro nick';
            exit();
        } elseif ($idUser != null) {
            echo 'El nick incertado ya está en uso. Por favor pruebe con otro';
            exit();
        } elseif ($email != null) {
            echo 'El email incertado ya está en uso. Por favor pruebe con otro';
            exit();
        } else {
            if ($this->user->set($user_data)) {
                header('Location: ../views/contenedor.php');
            } else {
                echo 'Usuario incorrecto inténtelo de nuevo.';
                exit();
            }
        }
    }
    public function createCantante($name){
        $cantante =new Cantante();
        $cantante->insertarCantante($name);
        header('Location: ../views/contenedor.php?$opcion=admincantantes');
    }
    public function eliminarCantante($name){
        $cantante =new Cantante();
        $cantante->delCantante($name);
        header('Location: ../views/contenedor.php?$opcion=admincantantes');
    }
    public function login($nick,$pass){

        if($this->cominit($nick)){
            $this->user = new UserR();
            $this->user->init_Session($nick,$pass);
        }
        else{
            $this->user = new Admin();
            $this->user->init_Session($nick,$pass);
        }

        header('Location: ../views/contenedor.php');
    }
    private function cominit($nick){
        $bool =true;
        $a =substr($nick, 0, 5);
        if($a =="admin"){
            $bool =false;
        }
        return $bool;
    }
    public function logout(){
        UserNoR::closeSession();
        $this->user = new UserNoR();
        header('location: ../views/contenedor.php');
    }
    public static function obtCantantes(){
        $admin =new Admin();
        $ver =$admin ->viewCantantes();
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["nombre_completo"];
            $b =$ver[$i]["followers"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Cantante: ";
            $mostrar.=$a;
            $mostrar.="<br/>";
            $mostrar.="Seguidores: ";
            $mostrar.=$b;
            $mostrar .='<form action="../controllers/controllerCantantes.php?$cantante='.$a.'" method="POST">
            <button type="submit">Eliminar</button></form></div>';
        }
        return $mostrar;
    }
    public static function verCantantes($idUser){
        $user =new UserR();
        $ver =$user->todosCantantes($idUser);
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["nombre_completo"];
            $b =$ver[$i]["followers"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Cantante: ";
            $mostrar.=$a;
            $mostrar.="<br/>";
            $mostrar.="Seguidores: ";
            $mostrar.=$b;
            $mostrar .='<form action="../controllers/controllerViewCantantes.php?$cantante='.$a.'" method="POST">
            <button type="submit">Seguir</button></form></div>';
        }

        return $mostrar;
    }
    public static function verTusCantantes($idUser){
        $user =new UserR();
        $ver =$user ->viewCantantes($idUser);
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["nombre_completo"];
            $b =$ver[$i]["followers"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Cantante: ";
            $mostrar.=$a;
            $mostrar.="<br/>";
            $mostrar.="Seguidores: ";
            $mostrar.=$b;
            $mostrar .='<form action="../controllers/controllerViewCantantes.php?$cantante='.$a.'" method="POST">
            <button type="submit">Dejar de Seguir</button></form></div>';
        }

        return $mostrar;
    }
    public static function obtConciertos(){
        $admin =new Admin();
        $ver =$admin ->viewConciertos();
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["fecha"];
            $b =$ver[$i]["lugar"];
            $c =$ver[$i]["nombre"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Nombre: ";
            $mostrar.=$c;
            $mostrar.="<br/>";
            $mostrar.="Lugar: ";
            $mostrar.=$b;
            $mostrar.=" Fecha: ";
            $mostrar.=$a;
            $mostrar .='<form action="../controllers/ControllerConciertos.php?$concierto='.$c.'" method="POST">
            <button type="submit">Eliminar</button></form></div>';
        }
        return $mostrar;
    }
    public static function verNoRConciertos(){
        $admin =new Admin();
        $ver =$admin ->viewConciertos();
        $cont =count($ver);
        $can =new Cantante();
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["fecha"];
            $b =$ver[$i]["lugar"];
            $c =$ver[$i]["nombre"];
            $d =$ver[$i]["idCantante"];
            $d =$can->getNick($d);
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Nombre: ";
            $mostrar.=$c;
            $mostrar.="<br/>";
            $mostrar.="Lugar: ";
            $mostrar.=$b;
            $mostrar.=" Fecha: ";
            $mostrar.=$a;
            $mostrar.=" Cantante: ";
            $mostrar.=$d;
            $mostrar.="</div>";
        }
        return $mostrar;
    }
    public static function verAbsCantantes(){
        $user =new UserNoR();
        $ver =$user ->view2Cantantes();
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $c =$ver[$i]["nombre_completo"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Nombre: ";
            $mostrar.=$c;
            $mostrar.="<br/>";
            $mostrar.="</div>";
        }
        return $mostrar;
    }

public function createConcierto($name,$fecha,$idCantante,$lugar){
    $concierto =new Conciertos();
    $concierto->insertarConcierto($name,$fecha,$idCantante,$lugar);
    header('Location: ../views/contenedor.php?$opcion=adminconciertos');

}
    public function eliminarConcierto($name){
        $concierto =new Conciertos();
        $concierto->delConcierto($name);
        header('Location: ../views/contenedor.php?$opcion=adminconciertos');

    }
    public static function adminUser(){
        $admin =new Admin();
        $ver =$admin->viewUsers();
        $cont =count($ver);
        $mostrar ="";
        for ($i = 0; $i < $cont; $i++) {
            $a =$ver[$i]["name"];
            $b =$ver[$i]["nick"];
            $c =$ver[$i]["email"];
            $mostrar.= '<div id="cantantes">';
            $mostrar.="Nombre: ";
            $mostrar.=$a;
            $mostrar.="<br/>";
            $mostrar.="Nick: ";
            $mostrar.=$b;
            $mostrar.=" Email: ";
            $mostrar.=$c;
            $mostrar .='<form action="../controllers/ControllerUser.php?$userdel='.$b.'" method="POST">
            <button type="submit">Eliminar</button></form></div>';
        }
        return $mostrar;
    }
    public function delUser($userdel){
        $user =new UserR();
        $user->delUserR($userdel);
        header('Location: ../views/contenedor.php?$opcion=adminUser');

    }

}
?>