<div class="lits index">
	<h2><?php echo __('Lits'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('meeting_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($lits as $lit): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($lit['Meeting']['datetime'], array('controller' => 'meetings', 'action' => 'view', $lit['Meeting']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link(__($users[$lit['User']['id']]), array('controller' => 'users', 'action' => 'view', $lit['User']['id'])); ?>
		</td>
		<td><?php echo h($lit['Lit']['title']); ?>&nbsp;</td>
		<td class="actions">
		<?php if(isset($currentUser['User']) and ($currentUser['User']['role']!= null)){ ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lit['Lit']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php if($currentUser['User']['office'] != null){ ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lit['Lit']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lit['Lit']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $lit['Lit']['id'])); ?>
			<?php }} ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing records {:start} - {:end} out of {:count}')
	));
	?>	</p>

	<div class="paging">
<?php echo $this->element('paging'); ?>
	</div>
</div>