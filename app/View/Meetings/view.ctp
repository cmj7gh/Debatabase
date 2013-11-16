<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<?php echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom.css'); ?>
<?php //echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom_edits_for_attendance.css'); ?>
<script>
  $(function() {
	var pickerOpts = {
        dateFormat:"yy-mm-dd"
    }; 
	$( "#datepicker" ).datepicker(pickerOpts);
	$( "#accordion" ).accordion({
      heightStyle: "content",
	  collapsible: true
    });
	$( "#tabs" ).tabs();
  });
</script>
<div class="meetings view">
<?php if($currentUser['User']['office'] != null){ ?>
<h2><?php echo('Meeting: ' . $meeting['Meeting']['display_name'] . "    " . $this->Form->postLink(__('Delete This Meeting'), array('action' => 'delete', $meeting['Meeting']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $meeting['Meeting']['id']))); ?></h2>
<?php }else{ ?>
<h2><?php  echo __('Meeting: ' . $meeting['Meeting']['display_name']); ?></h2>
<?php } ?>
	<div id="accordion">
	<h3>Meeting Details</h3>
	<div>
	<?php if($currentUser['User']['office'] != null){ ?>
	<?php echo $this->Html->link(__('Edit These Details'), array('action' => 'edit', $meeting['Meeting']['id']), array('class' => 'btn btn-info')); ?>
	<?php }?>
	<dl class="dl-horizontal">
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datetime'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['datetime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['value']); ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<h3>Attendance</h3>
	<div>
	<div class="related">
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Members In Attendance</a></li>
			<li><a href="#tabs-2">Provies at 1st Roll</a></li>
			<?php 
				if (!empty($combinedMeetings)):
					$tabCount = 3;
					foreach ($combinedMeetings as $m):
						echo("<li><a href=\"#tabs-". $tabCount . "\">Provies at " . $m['Meeting']['title'] . "</a></li>");
						$tabCount++;
					endforeach;
				endif;				
			?>
		</ul>
		<div id="tabs-1">
	<h3><?php echo __('Members in Attendance  ' . $this->Html->link(__('Edit This Roll Call'), array('controller' => 'users', 'action' => 'editRoll', $meeting['Meeting']['id']), array('class' => 'btn btn-info'))); ?> </h3>
	<?php if (!empty($meeting['User'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($meeting['User'] as $user): 
			if($user['role'] != 'provie'){
	?>
		
		<tr>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['role']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $user['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php }endforeach; ?>
	</table>
<?php endif; ?>
	</div>
	<div id="tabs-2">
	<h3><?php echo __('Provies in Attendance  ' . $this->Html->link(__('Edit This Roll Call'), array('controller' => 'users', 'action' => 'editRoll', $meeting['Meeting']['id']), array('class' => 'btn btn-info'))); ?></h3>
	<?php if (!empty($meeting['User'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($meeting['User'] as $user):
			if($user['role'] == 'provie'){
	?>
		<tr>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php //echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $user['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php }endforeach; ?>
	</table>
<?php endif; ?>
</div>
<?php if (!empty($combinedMeetings)): ?>
<?php
		$tabNumber = 3;
		foreach ($combinedMeetings as $m):
			echo("<div id=\"tabs-" . $tabNumber . "\">"); ?>
			<h3><?php echo __($m['Meeting']['title'].' Value: '.$m['Meeting']['value'] . "  " . $this->Html->link(__('Edit This Roll Call'), array('controller' => 'users', 'action' => 'editRoll', $m['Meeting']['id']), array('class' => 'btn btn-info'))); ?></h3>
				<table class="table table-hover" cellpadding = "0" cellspacing = "0">
					<tr>
						<th><?php echo __('First Name'); ?></th>
						<th><?php echo __('Last Name'); ?></th>
						<th><?php echo __('Email'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($m['User'] as $user): ?>
						<tr>
							<td><?php echo $user['first_name']; ?></td>
							<td><?php echo $user['last_name']; ?></td>
							<td><?php echo $user['email']; ?></td>
							<td class="actions">
							<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
								<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id']), array('class' => 'btn btn-small btn-success')); ?>
								<?php if($currentUser['User']['office'] != null){ ?>
								<?php //echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('class' => 'btn btn-small btn-info')); ?>
								<?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $user['id'])); ?>
								<?php }} ?>
							</td>
						</tr>
					<?php 
					endforeach;
					echo('</table>');
			echo('</div>');
			$tabNumber++;
		endforeach;
	endif;
?>
</div>
</div>
	</div>

	<h3>Lits</h3>
	<div>
	<div class="related">
	<h3><?php echo __('Lits Presented'); ?></h3>
	<?php if (!empty($meeting['Lit'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Presenter'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($meeting['Lit'] as $lit): 
	?>
		<tr>
			<td><?php echo $lit['User']['display_name']; ?></td>
			<td><?php echo $lit['title']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'lits', 'action' => 'view', $lit['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lits', 'action' => 'edit', $lit['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lits', 'action' => 'delete', $lit['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $lit['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
	<?php if($currentUser['User']['office'] != null){ ?>
<?php echo $this->Html->link(__('Add A Lit'), array('controller' => 'lits', 'action' => 'add', $meeting['Meeting']['id']), array('class' => 'btn btn-success')); ?>
<?php } ?>
	</div>
</div>
	</div>
	<h3>Debate</h3>
	<div>
	<div class="related">
	<h3><?php echo __('Debates'); ?></h3>
	<?php if (!empty($meeting['Debate'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Resolution'); ?></th>
		<th><?php echo __('Votes Gov'); ?></th>
		<th><?php echo __('Votes Opp'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($meeting['Debate'] as $debate): ?>
		<tr>
			<?php //var_dump($debate); ?>
			<td><?php echo $debate['resolution']; ?></td>
			<td><?php echo $debate['votes_gov']; ?></td>
			<td><?php echo $debate['votes_opp']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'debates', 'action' => 'view', $debate['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'debates', 'action' => 'edit', $debate['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'debates', 'action' => 'delete', $debate['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $debate['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
<?php if($currentUser['User']['office'] != null){ ?>
<?php echo $this->Html->link(__('Add A Debate'), array('controller' => 'debates', 'action' => 'add', $meeting['Meeting']['id']), array('class' => 'btn btn-success')); ?>
<?php } ?>
	</div>
</div>
	</div>
	</div>
</div>