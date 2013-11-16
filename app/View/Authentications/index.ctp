<div class="authentications index">
	<h2><?php echo __('Authentications'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('User.display_name'); ?></th>
			<th><?php echo $this->Paginator->sort('ipaddr'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('valid'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
	</tr>
	<?php
	foreach ($authentications as $authentication): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($authentication['User']['display_name'], array('controller' => 'users', 'action' => 'view', $authentication['User']['id'])); ?>
		</td>
		<td><?php echo h($authentication['Authentication']['ipaddr']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['value']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['valid']); ?>&nbsp;</td>
		<!--<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $authentication['Authentication']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $authentication['Authentication']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $authentication['Authentication']['id']), null, __('Are you sure you want to delete # %s?', $authentication['Authentication']['id'])); ?>
		</td>-->
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
