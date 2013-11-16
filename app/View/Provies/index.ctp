<div class="provies index">
	<h2><?php echo __('Provies'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('User.display_name', 'Provie'); ?></th>
			<th><?php echo $this->Paginator->sort('attendance'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('service_to_sarge', 'Service Sarge'); ?></th>
			<th><?php echo $this->Paginator->sort('service_to_officer', 'Service Officer'); ?></th>-->
			<th><?php echo $this->Paginator->sort('debate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lit_id'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('is_active', 'Active?'); ?></th>-->
			<th><?php echo $this->Paginator->sort('Proviepoints', 'Points'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('inductions_elligible', 'Inductable?'); ?></th>-->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($provies as $provy): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($provy['User']['display_name'], array('controller' => 'users', 'action' => 'view', $provy['User']['id'])); ?>
		</td>
		<td><?php echo h($provy['Provy']['attendance']); ?>&nbsp;</td>
		<!--<td><?php echo h($provy['Provy']['service_to_sarge']); ?>&nbsp;</td>
		<td><?php echo h($provy['Provy']['service_to_officer']); ?>&nbsp;</td>-->
		<td>
			<?php echo $this->Html->link($provy['Debate']['id'], array('controller' => 'debates', 'action' => 'view', $provy['Debate']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($provy['Lit']['title'], array('controller' => 'lits', 'action' => 'view', $provy['Lit']['id'])); ?>
		</td>
		<!--<td><?php echo h($provy['Provy']['is_active']); ?>&nbsp;</td>-->
		<td><?php echo h($provy['Provy']['Proviepoints']); ?>&nbsp;</td>
		<!--<td><?php echo h($provy['Provy']['inductions_elligible']); ?>&nbsp;</td>-->
		<td class="actions">
		<?php if(isset($currentUser['User']['role']) and  ($currentUser['User']['role']!= null)){ ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $provy['Provy']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php if($currentUser['User']['office'] != null){ ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $provy['Provy']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $provy['Provy']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $provy['Provy']['id'])); ?>
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