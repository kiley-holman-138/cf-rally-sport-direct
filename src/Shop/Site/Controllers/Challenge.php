<?php

namespace Shop\Site\Controllers;

class Challenge extends \Dsc\Controller {
    /**
     * Register index method and render the proper view with variables.
    **/
    public function index(){
        $this->registerName(__METHOD__);//registerName
        $fullName = 'Kiley Holman';//my full name as variable
        $age = 31;//my age as variable

        $this->app->set('fullName', $fullName);//set fullName variable for the view
        $this->app->set('age', $age);//set age variable for the view

        $view = \Dsc\System::instance()->get('theme');//Not sure what this does, if I would have to guess this is getting css or maybe a template?
        echo $view->render('Shop/Site/Views::challenge/challenges.php');//render the challenges.php view.
    }

}