<?php

class UsersController extends AppController {

    public $helpers = array('Html', 'Form');
    public $paginate = array(
        'order' => array('User.username' => 'asc'),
        'maxLimit' => ''
    );

    public function flash($message, $class = 'status') {
        $old = $this->Session->read('messages');
        $old[$class][] = $message;
        $this->Session->write('messages', $old);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('controller' => 'items', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function uindex() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate('User'));
    }

    public function uview($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function uedit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The changes have been saved'), 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'uview/' . $id));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function changepass($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
//        debug($this->request->data);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->data['User']['password'] = $this->request->data['User']['newpass'];
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Your new password has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('controller' => 'items', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
            }
        } else {
            if ($this->Auth->user('id') != 1) {
                if ($this->Auth->user('id') != $id) {
                    $this->Session->setFlash('You are not allowed that operation!');
                    $this->redirect(array('controller' => 'users', 'action' => 'uindex'));
                }
            }
            $this->request->data = $this->User->read(null, $id);
            debug($this->request->data);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function resetpass($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
//        debug($this->request->data);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->data['User']['password'] = $this->request->data['User']['newpass'];
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Password has been reset'), 'default', array('class' => 'success'));
                $this->redirect(array('controller' => 'items', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
            }
        } else {
            if ($this->Auth->user('id') != 1) {
                if ($this->Auth->user('id') != $id) {
                    $this->Session->setFlash('You are not allowed that operation!');
                    $this->redirect(array('controller' => 'users', 'action' => 'uindex'));
                }
            }
            $this->request->data = $this->User->read(null, $id);
            debug($this->request->data);
            unset($this->request->data['User']['password']);
        }
    }

    public function unserializesession($data) {
        if (strlen($data) == 0) {
            return array();
        }
        // match all the session keys and offsets
        preg_match_all('/(^|;|\})([a-zA-Z0-9_]+)\|/i', $data, $matchesarray, PREG_OFFSET_CAPTURE);

        $returnArray = array();

        $lastOffset = null;
        $currentKey = '';
        foreach ($matchesarray[2] as $value) {
            $offset = $value[1];
            if (!is_null($lastOffset)) {
                $valueText = substr($data, $lastOffset, $offset - $lastOffset);
                $returnArray[$currentKey] = unserialize($valueText);
            }
            $currentKey = $value[0];

            $lastOffset = $offset + strlen($currentKey) + 1;
        }

        $valueText = substr($data, $lastOffset);
        $returnArray[$currentKey] = unserialize($valueText);

        return $returnArray;
    }

    public function getLoggedInUsersInner() {
        App::import('model', 'model_name');
        $session = new model_name();
        $sessions = $session->find('all', array('fields' => 'data'));
        $loggedInUsers = array();

        foreach ($sessions as &$s) {
            $s = $this->unserializesession($s['CakeSession']['data']);
            if (isset($s['Auth']['User']['id'])) {
                $loggedInUsers[] = $s['Auth']['User']['id'];
            }
        }
        return array_unique($loggedInUsers);
    }
}
?>

