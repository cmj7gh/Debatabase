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
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('first_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('email', array('label' => array('class' => 'control-label'), 'disabled' => true));
		echo $this->Form->input('graduation_year', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('phone_number', array('label' => array('class' => 'control-label')));
		if($currentUser['User']['office'] != null){
			//echo $this->Form->input('role', array('type'=>'select','options'=>array('officer'=>'officer','provie'=>'provie','member'=>'member','alum'=>'alum'),'selected'=>$this->request->data['User']['role']));
			//echo $this->Form->input('password');
			//echo $this->Form->input('Meeting');
		}
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