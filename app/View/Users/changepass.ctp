<?php
echo $this->Form->create('User');
echo $this->Form->input('id');
echo $this->Form->input('current_password', array('type'=>'password'));
echo $this->Form->input('newpass', array('label'=>'New password', 'type'=>'password'));
echo $this->Form->end('Submit');
?>