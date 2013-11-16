<div class="lits view">
<h2><?php  echo __('Lit'); ?></h2>
<?php echo $this->Html->link(__('Edit This Lit'), array('action' => 'edit', $lit['Lit']['id']), array('class' => 'btn btn-info')); ?>
<?php echo $this->Form->postLink(__('Delete This Lit'), array('action' => 'delete', $lit['Lit']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $lit['Lit']['id'])); ?>
	<dl class="dl-horizontal">
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lit['Lit']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Meeting'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lit['Meeting']['id'], array('controller' => 'meetings', 'action' => 'view', $lit['Meeting']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lit['User']['display_name'], array('controller' => 'users', 'action' => 'view', $lit['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($lit['Lit']['title']); ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lit['Lit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lit['Lit']['modified']); ?>
			&nbsp;
		</dd>-->
	</dl>
</div>
