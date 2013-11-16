<div class="alumni view">
<h2><?php  echo __($alumnus['User']['display_name']); ?></h2>
	<dl class="dl-horizontal">
		<!--
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($alumnus['Alumnus']['id']); ?>
			&nbsp;
		</dd>
		-->
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($alumnus['User']['display_name'], array('controller' => 'users', 'action' => 'view', $alumnus['User']['id'])); ?>
			&nbsp;
		</dd>
		<?php 
		//so many conditions - sorry to whoever has to debug this :/
		if(($alumnus['Alumnus']['show_who'] == 'all') 
					|| ($alumnus['Alumnus']['show_who'] == 'alumni' && $currentUser['User']['role'] == 'alum')
					|| ($alumnus['Alumnus']['show_who'] == 'alumni' && $currentUser['User']['office'] == 'alumnichair')
					|| ($alumnus['Alumnus']['show_who'] == 'alumni' && $currentUser['User']['office'] == 'president')
					|| ($alumnus['Alumnus']['show_who'] == 'chair' && $currentUser['User']['office'] == 'alumnichair')
					|| ($currentUser['User']['id'] == $alumnus['Alumnus']['user_id'])
					|| ($alumnus['Alumnus']['show_who'] == 'chair' && $currentUser['User']['office'] == 'president')){ ?>
		<dt><?php echo __('Current Address'); ?></dt>
		<dd>
			<?php echo(h($alumnus['Alumnus']['current_address']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grad School'); ?></dt>
		<dd>
			<?php echo(h($alumnus['Alumnus']['grad_school']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Industry'); ?></dt>
		<dd>
			<?php echo(h($alumnus['Alumnus']['industry']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo(h($alumnus['Alumnus']['company']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo(h($alumnus['Alumnus']['position']));?>
			&nbsp;
		</dd>
		<?php }else{ ?>
		<dt>Current Alumni Info</dt>
		<dd>Not Available</dd>
		<?php } ?>
		<!--<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($alumnus['Alumnus']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($alumnus['Alumnus']['modified']); ?>
			&nbsp;
		</dd>-->
	</dl>
</div>
<?php if($currentUser['Officer']){ ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Alumnus'), array('action' => 'edit', $alumnus['Alumnus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Alumnus'), array('action' => 'delete', $alumnus['Alumnus']['id']), null, __('Are you sure you want to delete # %s?', $alumnus['Alumnus']['id'])); ?> </li>
	</ul>
</div>
<?php } ?>
