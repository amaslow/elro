<?php
echo $this->Form->create('User');
?>
<table class="erp_top">
    <tr>
        <td>ID: </td>
        <td><?php echo $this->Form->input('id', array('label' => false)); ?></td>
    </tr>
    <tr>
        <td>Username: </td>
        <td><?php echo $this->Form->input('username', array('label' => false)); ?></td>
    </tr>
    <tr>
        <td>Created: </td>
        <td><?php echo $user['User']['created']; ?></td>
    </tr>
    <tr>
        <td>Group: </td>
        <td><?php echo $this->Form->input('group', array('label' => false)); ?></td>
    </tr>
</table>
<?php
echo $this->Form->end('Save');
?>