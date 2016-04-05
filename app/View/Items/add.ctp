<h1>Add product</h1>

<?php
echo $this->Form->create('Product');
echo $this->Form->input('SAP');
echo $this->Form->input('ITEM', array('rows' => '4'));
echo $this->Form->end('Add');
?>
<p>
    <?php echo $this->Html->link('Back', array('controller' => 'items', 'action' => 'index')); ?>
</p>