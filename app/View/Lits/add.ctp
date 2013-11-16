<div class="lits form">
<?php echo $this->Html->link(__('If The Presenter Is Not Yet In The Debatabase, Click Here To Add Them First'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-info')); ?>
<?php echo $this->Form->create('Lit', array('action'=>'add/'.$meetingId, 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add Lit'); ?></legend>
	<?php
		echo $this->Form->input('meeting_id', array('default' => $meetingId, 'label' => array('class' => 'control-label')));
		echo $this->Form->input('user_id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('title', array('label' => array('class' => 'control-label')));
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