<div class="meetings form">
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<legend><?php echo __('Add Meeting'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('datetime');
		echo $this->Form->input('value');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Meetings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Debates'), array('controller' => 'debates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Debate'), array('controller' => 'debates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lits'), array('controller' => 'lits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lit'), array('controller' => 'lits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
