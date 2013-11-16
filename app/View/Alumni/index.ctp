<div class="provies index">
	<h2><?php echo __('Alumni'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('User.display_name', 'Alumnus'); ?></th>
			<th><?php echo $this->Paginator->sort('current_address'); ?></th>
			<th><?php echo $this->Paginator->sort('grad_school'); ?></th>
			<th><?php echo $this->Paginator->sort('industry'); ?></th>
			<th><?php echo $this->Paginator->sort('company'); ?></th>
			<th><?php echo $this->Paginator->sort('position'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($alumni as $alumnus): 
		if($alumnus['User']['role'] == 'alum'):?>
	<tr>
		<td>
			<?php echo $this->Html->link($alumnus['User']['display_name'], array('controller' => 'users', 'action' => 'view', $alumnus['User']['id'])); ?>
		</td>
		<?php 
		//so many conditions - sorry to whoever has to debug this :/
		if(($alumnus['Alumnus']['show_who'] == 'all') 
					|| ($alumnus['Alumnus']['show_who'] == 'alumni' && $currentUser['User']['role'] == 'alum') 
					|| ($alumnus['Alumnus']['show_who'] == 'chair' && $currentUser['User']['office'] == 'alumnichair')
					|| ($currentUser['User']['id'] == $alumnus['Alumnus']['user_id'])
					|| ($alumnus['Alumnus']['show_who'] == 'chair' && $currentUser['User']['office'] == 'president')){ ?>
		<td><?php echo h($alumnus['Alumnus']['current_address']); ?>&nbsp;</td>
		<td><?php echo h($alumnus['Alumnus']['grad_school']); ?>&nbsp;</td>
		<td><?php echo h($alumnus['Alumnus']['industry']); ?>&nbsp;</td>
		<td><?php echo h($alumnus['Alumnus']['company']); ?>&nbsp;</td>
		<td><?php echo h($alumnus['Alumnus']['position']); ?>&nbsp;</td>
		<?php }else{ ?>
		<td>Not Available&nbsp;</td>
		<td>Not Available&nbsp;</td>
		<td>Not Available&nbsp;</td>
		<td>Not Available&nbsp;</td>
		<td>Not Available&nbsp;</td>
		<?php } ?>
		<td class="actions">
		<?php if(isset($currentUser['User']) and ($currentUser['User']['role']!= null)){ ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $alumnus['Alumnus']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php if($currentUser['User']['office'] != null){ ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $alumnus['Alumnus']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $alumnus['Alumnus']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $alumnus['Alumnus']['id'])); ?>
			<?php }} ?>
		</td>
	</tr>
<?php endif; endforeach; ?>
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