<div class="provies form">
<?php echo $this->Form->create('Provy'); ?>
	<fieldset>
		<legend><?php echo __('Add Provy'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('service_to_sarge');
		echo $this->Form->input('service_to_officer');
		echo $this->Form->input('debate_id');
		echo $this->Form->input('lit_id');
		echo $this->Form->input('is_active');
		echo $this->Form->input('points');
		echo $this->Form->input('inductions_elligible');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Provies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Debates'), array('controller' => 'debates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Debate'), array('controller' => 'debates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lits'), array('controller' => 'lits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lit'), array('controller' => 'lits', 'action' => 'add')); ?> </li>
	</ul>
</div>
