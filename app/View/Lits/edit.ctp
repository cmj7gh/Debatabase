<div class="lits form">
<?php echo $this->Form->create('Lit', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Edit Lit'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('meeting_id', array('label' => array('class' => 'control-label')));
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
<?php echo $this->Form->postLink(__('Delete This Lit'), array('action' => 'delete', $this->Form->value('Lit.id')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Lit.id'))); ?>
</div>
