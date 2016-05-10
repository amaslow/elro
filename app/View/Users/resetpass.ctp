<?php
echo $this->Form->create('User');
echo $this->Form->input('id');
echo $this->Form->input('newpass', array('label'=>'New password', 'value'=>'Welkom2016'));
echo $this->Form->end('RESET');
?>