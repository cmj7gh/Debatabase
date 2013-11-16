<div class="users form">
<?php echo $this->Form->create('User', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('first_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('label' => array('class' => 'control-label')));
		echo('<div class="control-group">');
		echo('<div class="control-label">Email</div>');
		echo('<div class="controls">');
		echo('<div class="input-append">');
		echo('<input type="text" placeholder="Email" name="data[User][email]" id="email">');
		echo('<span class="add-on">@virginia.edu</span>');
		echo('</div></div></div>');
		
		//echo $this->Form->input('email', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('role', array('label' => array('class' => 'control-label'), 'type'=>'select','options'=>array('officer'=>'officer','provie'=>'provie','member'=>'member','alum'=>'alum'),'selected'=>'provie'));
		echo $this->form->input('_App.referer', array('value' => $referer, 'type' => 'hidden')); 
	?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>

