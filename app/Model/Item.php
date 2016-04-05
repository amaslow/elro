<?php

class Item extends AppModel {

    public $validate = array(
        'ITEM' => array(
            'rule' => 'notEmpty'
        ),
        'SAP' => array(
            'rule' => 'notEmpty'
        ),
        'BRAND' => array(
            'rule' => 'notEmpty'
        )
    );

}

?>