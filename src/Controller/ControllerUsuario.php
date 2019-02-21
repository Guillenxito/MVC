<?php
class ControllerUsuario extends BaseController {

    public function login(){
        if(count($_POST)>0){
            // Aquí debéis preguntar a los modelos
            // Yo siempre que me envíen algo lo pongo a true
            Session::getInstance()->set('AUTH', true);
            App::getRouter()->redirect('/');
        }
    }

    public function salir(){
        Session::getInstance()->set('AUTH', false);
        App::getRouter()->redirect('/');
    }
}
?>
