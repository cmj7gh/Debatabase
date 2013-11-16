<div class="debates index">
	<h2><?php echo __('Debates'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('meeting_id'); ?></th>
			<th><?php echo $this->Paginator->sort('resolution'); ?></th>
			<th><?php echo $this->Paginator->sort('votes_gov'); ?></th>
			<th><?php echo $this->Paginator->sort('votes_opp'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($debates as $debate): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($debate['Meeting']['display_name'], array('controller' => 'meetings', 'action' => 'view', $debate['Meeting']['id'])); ?>
		</td>
		<td><?php echo ($debate['Debate']['resolution']); ?>&nbsp;</td>
		<td><?php echo ($debate['Debate']['votes_gov']); ?>&nbsp;</td>
		<td><?php echo ($debate['Debate']['votes_opp']); ?>&nbsp;</td>
		<td class="actions">
		<?php if(isset($currentUser['User']) and ($currentUser['User']['role']!= null)){ ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $debate['Debate']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php if($currentUser['User']['office'] != null){ ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $debate['Debate']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $debate['Debate']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $debate['Debate']['id'])); ?>
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