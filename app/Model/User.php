<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $validate = array(
        'username' => array(
            'znaki' => array(
                'required' => 'true',
                'rule' => 'alphaNumeric',
                'message' => 'Only digits and letters'
            ),
            'dlugosc' => array(
                'rule' => array('between', 2, 20),
                'message' => 'Between 2 and 20 characters'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '2'),
            'message' => 'Minumum 2 characters'
        ),
        'current_password' => array(
            'rule' => 'checkCurrentPassword',
            'message' => 'This is not your current password'
        ),
        'newpass' => array(
            'rule' => array('minLength', '2'),
            'message' => 'Minumum 2 characters'
        )
    );
    
    public function checkCurrentPassword($data) {
        $this->id = AuthComponent::user('id');
        $password = $this->field('password');
        return(AuthComponent::password($data['current_password']) == $password);
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        if (isset($this->data[$this->alias]['newpass'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['newpass']);
        }
        return true;
    }

}

?>