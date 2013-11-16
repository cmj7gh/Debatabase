<h3> Washington Society Administration Page</h3>
<p>Current Members, Provies, and Alumni should login with netbadge <a href="/~wash/netbadge/">here</a></p>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => '')));
    echo $this->Form->input('email', array('label' => array('class' => 'control-label')));
    echo $this->Form->input('password', array('label' => array('class' => 'control-label')));
	
    //echo $this->Form->end('Login');
?>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Login'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
<hr>
<!--<h1> If this is your first time here, you'll need to create an account:</h1>
<?php
	echo $this->Form->create('User', array('action'=>'register/coach'));
	echo $this->Form->end('Create An Account');
?>


<p>(UVA people can login <a href="/~hspc/registration/netbadge">here</a>)</p>-->