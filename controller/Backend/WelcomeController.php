<?php
namespace Controller\Backend;

use Library\Controller;
use Model\Usuario;


class WelcomeController extends Controller {
    static $template = 'Layout/base.html.php';

    function indexAction(){
        //revisa que tipo de perfil tiene el Usuario
        //muestra los botones o redirige a la opcion segun
        //el perfil.
        //define las opciones que debe mostrar la plataforma
        $user = $_SESSION['user'];
        if($user['perfil'] == 3){
            $this->redirect('/backend/atencion');
        }
        return [];
    }
}
