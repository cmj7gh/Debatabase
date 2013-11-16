<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('User.display_name', 'Name'); ?></th>
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
			<th><?php echo $this->Paginator->sort('User.phone_number', 'Phone Number'); ?> </th>
			<th><?php echo $this->Paginator->sort('User.dues_status', 'Dues'); ?></th>
			<? } ?>
			<th><?php echo $this->Paginator->sort('User.graduation_year', 'Graduation'); ?> </th>
			<th><?php echo $this->Paginator->sort('User.office', 'Role'); //this page only shows members, so everyone's role will be member. Makes more sense to sort by office?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php 
				if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){
					echo $this->Html->link($user['User']['display_name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); 
				}else{
					echo $user['User']['display_name'];
				}
			?>&nbsp;</td>
		<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
		<td><?php echo h($user['User']['phone_number']); ?>&nbsp;</td>
		<td><?php if($user['User']['dues_status']){echo('Paid');}else{echo('Unpaid');} ?>&nbsp;</td>
		<?php } ?>
		<td><?php echo h($user['User']['graduation_year']); ?>&nbsp;</td>
		<td><?php if($user['User']['office'] != null){echo h($user['User']['office']);}else{echo h($user['User']['role']);} ?>&nbsp;</td>
		<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php if($currentUser['User']['office'] != null){ ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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