<?php
echo $this->Form->create('User');
?>
<table class="erp_top">
    <tr>
        <td>ID: </td>
        <td><?php echo $user['User']['id']; ?></td>
    </tr>
    <tr>
        <td>Username: </td>
        <td><?php echo $user['User']['username']; ?></td>
    </tr>
    <tr>
        <td>Created: </td>
        <td><?php echo $user['User']['created']; ?></td>
    </tr>
    <tr>
        <td>Group: </td>
        <td><?php echo $user['User']['group']; ?></td>
    </tr>
</table>
<?php
echo $this->Html->link('Edit', array('action' => 'uedit', $user['User']['id']), array('class' => 'button'));
echo $this->Html->link('Change password', array('action' => 'changepass', $user['User']['id']), array('class' => 'button'));
echo $this->Html->link('Reset password', array('action' => 'resetpass', $user['User']['id']), array('class' => 'button'));
?>