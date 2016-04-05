<?php

if (AuthComponent::user('id') == 1) {
    echo '<h4>';
    echo $this->Html->link('Add user', array('controller' => 'users', 'action' => 'add'));
    echo '</h4>';
    echo '<h4>';
        echo $this->Html->link('Items database', array('controller' => 'items', 'action' => 'index'));
    echo '</h4>';
}
?>

<h4 style="float: right"><?php
    if ($this->Session->read('Auth.User')) {
        echo $this->Html->link('Logout  ' . AuthComponent::user('username'), array('controller' => 'users', 'action' => 'logout'));
    } else {
        echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
    }
    ?></h4>

<table class="index">
    <tr>
        <th><?php echo $this->Paginator->sort('id', 'id') ?></th>
        <th><?php echo $this->Paginator->sort('username', 'username') ?></th>
        <th><?php echo $this->Paginator->sort('created', 'created') ?></th>
        <th><?php echo $this->Paginator->sort('group', 'group') ?></th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['id']; ?></td>
            <td><?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'uview', $user['User']['id']), array('target' => '_blank')); ?></td>
            <td><?php echo $user['User']['created']; ?></td>
            <td><?php echo $user['User']['group']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>