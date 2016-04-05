<div class="user form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Enter your username and password to login'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        ?>
    </fieldset>
<?php echo $this->Form->end('Login'); ?>

</div>