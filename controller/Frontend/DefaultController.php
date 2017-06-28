<?php
namespace Controller\Frontend;

use Library\Controller;
use Model\Entity\Usuario;

class DefaultController extends Controller {
    static $template ='Layout/base.html.php';

    function indexAction(){
        $this->redirect('/frontend/auth/signin');
    }
}
