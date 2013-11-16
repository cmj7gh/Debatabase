<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<?php echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom_edits_for_attendance.css'); ?>
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
  });
</script>

<div class="users view">
<h2><?php  echo __($user['User']['display_name']); ?></h2>
<?php if($currentUser['User']['office'] != null){ ?>
<?php echo $this->Html->link(__('Edit This User'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-large btn-info')); ?>
<?php echo $this->Form->postLink(__('Delete This User'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-large btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
<?php } ?>
<div id="accordion">
	<h3>User Details</h3>
	<div>
	<dl class="dl-horizontal">
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dues Expire'); ?></dt>
		<dd>
			<?php echo h($user['User']['dues_expire']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php if($user['User']['office'] != null){echo h($user['User']['office']);}else{echo h($user['User']['role']);} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Graduation Year'); ?></dt>
		<dd>
			<?php echo h($user['User']['graduation_year']); ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>-->
	</dl>
	<div class="related">
	<h3><?php echo __('Data From Provie Semester'); ?></h3>
	<?php if (!empty($user['Provy'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Service To Sarge'); ?></th>
		<th><?php echo __('Service To Officer'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Inductions Elligible'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Provy'] as $provy): ?>
		<tr>
			<td><?php echo $provy['service_to_sarge']; ?></td>
			<td><?php echo $provy['service_to_officer']; ?></td>
			<td><?php echo $provy['is_active']; ?></td>
			<td><?php echo $provy['points']; ?></td>
			<td><?php echo $provy['inductions_elligible']; ?></td>
			<td><?php echo $provy['created']; ?></td>
			<td><?php echo $provy['modified']; ?></td>
			<td class="actions">
				<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'provies', 'action' => 'view', $provy['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'provies', 'action' => 'edit', $provy['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'provies', 'action' => 'delete', $provy['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $provy['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<?php if (!empty($user['Alumnus'])): ?>
	<h3><?php echo __('Data As Alumnus'); ?></h3>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Current Address'); ?></th>
		<th><?php echo __('Grad School'); ?></th>
		<th><?php echo __('Industry'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Alumnus'] as $alumnus): ?>
		<tr>
			<td><?php echo $alumnus['current_address']; ?></td>
			<td><?php echo $alumnus['grad_school']; ?></td>
			<td><?php echo $alumnus['industry']; ?></td>
			<td><?php echo $alumnus['company']; ?></td>
			<td><?php echo $alumnus['position']; ?></td>
			<td><?php echo $alumnus['created']; ?></td>
			<td><?php echo $alumnus['modified']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'alumni', 'action' => 'view', $alumnus['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'alumni', 'action' => 'edit', $alumnus['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'alumni', 'action' => 'delete', $alumnus['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $alumnus['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
	</div>
	<h3>Attendance</h3>
	<div>
	<div class="related">
	<h3><?php echo __('Meetings Attended'); ?></h3>
	<?php if (!empty($user['Meeting'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Datetime'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Meeting'] as $meeting): ?>
		<tr>
			<td><?php 	if($meeting['parent_id'] != null){
							echo ($meetings[$meeting['parent_id']] . ': ');
						}
						echo $meeting['display_name']; 
				?>
			</td>
			<td><?php echo $meeting['datetime']; ?></td>
			<td><?php echo $meeting['value']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'meetings', 'action' => 'view', $meeting['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'meetings', 'action' => 'edit', $meeting['id']),array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'meetings', 'action' => 'delete', $meeting['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $meeting['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	</div>
	</div>
	<h3>Debates</h3>
	<div>
	<div class="related">
	<h3><?php echo __('Debates'); ?></h3>
	<?php if (!empty($debates)): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Resolution'); ?></th>
		<th><?php echo __('Meeting Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($debates as $debate): ?>
		<tr>
			<td><?php echo $debate['Debate']['id']; ?></td>
			<td><?php echo $debate['Debate']['resolution']; ?></td>
			<td><?php echo $debate['Debate']['meeting_id']; ?></td>
			<td><?php echo $debate['Debate']['created']; ?></td>
			<td><?php echo $debate['Debate']['modified']; ?></td>
			<td class="actions">
			<?php if(isset($currentUser['User']['role']) and ($currentUser['User']['role']!= null)){ ?>
				<?php echo $this->Html->link(__('View'), array('controller' => 'debates', 'action' => 'view', $debate['Debate']['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php if($currentUser['User']['office'] != null){ ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'debates', 'action' => 'edit', $debate['Debate']['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'debates', 'action' => 'delete', $debate['Debate']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $debate['Debate']['id'])); ?>
				<?php }} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<!--<div class="actions">
			<?php echo $this->Html->link(__('New Debate'), array('controller' => 'debates', 'action' => 'add'), array('class' => 'btn btn-success')); ?>
	</div>-->


</div>
	</div>
	<h3>Lits</h3>
	<div>
	<div class="related">
	<h3><?php echo __('Lits'); ?></h3>
	<?php if (!empty($user['Lit'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Meeting Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Lit'] as $lit): ?>
		<tr>
			<td><?php echo $lit['id']; ?></td>
			<td><?php echo $this->Html->link(__($lit['meeting_id']), array('controller' => 'meetings', 'action' => 'view', $lit['meeting_id'])); ?></td>
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

	<!--<div class="actions">
			<?php echo $this->Html->link(__('New Lit'), array('controller' => 'lits', 'action' => 'add'), array('class' => 'btn btn-success')); ?>
	</div>-->
</div>
	</div>
	</div>
</div>

<?php if($currentUser['User']['office'] == 'webmaster'){ ?>
<div class="related">
	<h3><?php echo __('Related Authentications'); ?></h3>
	<?php if (!empty($user['Authentication'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Ipaddr'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Valid'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Authentication'] as $authentication): ?>
		<tr>
			<td><?php echo $authentication['id']; ?></td>
			<td><?php echo $authentication['user_id']; ?></td>
			<td><?php echo $authentication['ipaddr']; ?></td>
			<td><?php echo $authentication['value']; ?></td>
			<td><?php echo $authentication['valid']; ?></td>
			<td><?php echo $authentication['created']; ?></td>
			<td><?php echo $authentication['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'authentications', 'action' => 'view', $authentication['id']), array('class' => 'btn btn-small btn-success')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<h3><?php echo __('Related Logs'); ?></h3>
	<?php if (!empty($user['Log'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Controller'); ?></th>
		<th><?php echo __('Function'); ?></th>
		<th><?php echo __('Details'); ?></th>
		<th><?php echo __('Theid'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Ipaddr'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Log'] as $log): ?>
		<tr>
			<td><?php echo $log['id']; ?></td>
			<td><?php echo $log['user_id']; ?></td>
			<td><?php echo $log['controller']; ?></td>
			<td><?php echo $log['function']; ?></td>
			<td><?php echo $log['details']; ?></td>
			<td><?php echo $log['theid']; ?></td>
			<td><?php echo $log['url']; ?></td>
			<td><?php echo $log['data']; ?></td>
			<td><?php echo $log['ipaddr']; ?></td>
			<td><?php echo $log['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'logs', 'action' => 'view', $log['id']), array('class' => 'btn btn-small btn-success')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<?php } ?>




