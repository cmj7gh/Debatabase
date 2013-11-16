<div class="provies form">
<?php echo $this->Form->create('Provy',array('action'=>'givePoints', 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Enter Points Earned'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('value', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('reason', array('label' => array('class' => 'control-label')));
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