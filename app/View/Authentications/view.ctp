<div class="authentications view">
<h2><?php  echo __('Authentication'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($authentication['User']['id'], array('controller' => 'users', 'action' => 'view', $authentication['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ipaddr'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['ipaddr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['valid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Authentication'), array('action' => 'edit', $authentication['Authentication']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Authentication'), array('action' => 'delete', $authentication['Authentication']['id']), null, __('Are you sure you want to delete # %s?', $authentication['Authentication']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Authentications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Authentication'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
