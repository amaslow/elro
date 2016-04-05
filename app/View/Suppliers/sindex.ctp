<?php
if ($this->Session->read('Auth.User')) {
    echo $this->Html->link('ITEMS database', array('controller' => 'items', 'action' => 'index'), array('target' => '_blank','class' => 'button'));
}
?>

<h4 style="float: right"><?php
    if ($this->Session->read('Auth.User')) {
        echo $this->Html->link('Logout  ' . AuthComponent::user('username'), array('controller' => 'users', 'action' => 'logout'));
    } else {
        echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
    }
    ?></h4>
<?php
echo $this->Form->create(null, array('type' => 'get'));
echo $this->Form->input('filter', array('type' => 'text'));
echo $this->Form->end();
?>
<table class="index">
    <tr>
        <th><?php echo $this->Paginator->sort('SUPPLIER', 'Supplier') ?></th>
        <th><?php echo $this->Paginator->sort('OFFICE_VENDOR', 'Office SAP') ?></th>
        <th><?php echo $this->Paginator->sort('OFFICE_NAME1', 'Office') ?></th>
        <th><?php echo $this->Paginator->sort('FACTORY1_NAME1', 'Factory 1') ?></th>
        <th><?php echo $this->Paginator->sort('FACTORY2_NAME1', 'Factory 2') ?></th>
        <th><?php echo $this->Paginator->sort('FACTORY3_NAME1', 'Factory 3') ?></th>
        
    </tr>
    <?php foreach ($suppliers as $supplier): ?>
        <tr>
            <td><?php echo $this->Html->link($supplier['Supplier']['SUPPLIER'], array('controller' => 'suppliers', 'action' => 'sview', $supplier['Supplier']['ID']), array('target' => '_blank')); ?></td>
            <td><?php echo $supplier['Supplier']['OFFICE_VENDOR']; ?></td>
            <td><?php echo $supplier['Supplier']['OFFICE_NAME1']; ?></br><?php echo $supplier['Supplier']['OFFICE_NAME2']; ?></td>
            <td><?php echo $supplier['Supplier']['FACTORY1_NAME1']; ?></br><?php echo $supplier['Supplier']['FACTORY1_NAME2']; ?></td>
            <td><?php echo $supplier['Supplier']['FACTORY2_NAME1']; ?></br><?php echo $supplier['Supplier']['FACTORY2_NAME2']; ?></td>
            <td><?php echo $supplier['Supplier']['FACTORY3_NAME1']; ?></br><?php echo $supplier['Supplier']['FACTORY3_NAME2']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>