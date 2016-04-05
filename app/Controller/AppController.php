<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');

    }

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'items', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'items', 'action' => 'index'),
        )
    );
    
}
