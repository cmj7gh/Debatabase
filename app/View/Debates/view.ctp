<div class="debates view">
<?php //var_dump($debate); ?>
<h2><?php  echo __('Debate'); ?></h2>
<?php echo $this->Html->link(__('Edit This Debate'), array('action' => 'edit', $debate['Debate']['id']), array('class' => 'btn btn-info')); ?>
<?php echo $this->Form->postLink(__('Delete This Debate'), array('action' => 'delete', $debate['Debate']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $debate['Debate']['id'])); ?>
	<dl class="dl-horizontal">
		<dt><?php echo __('Meeting'); ?></dt>
		<dd>
			<?php echo $this->Html->link($debate['Meeting']['display_name'], array('controller' => 'meetings', 'action' => 'view', $debate['Meeting']['id'])); ?>
			&nbsp;
		</dd>
		<?php 
			foreach($debate['Debater'] as $debater) {
				echo('<dt>'); 
				echo __($debater['role']); 
				echo('</dt>');
				echo('<dd>');
					if(isset($debater['user_id'])){
					 echo ($this->Html->link($users[$debater['user_id']],array('controller'=>'users','action'=>'view',$debater['user_id'])));
					}else{
						echo('NULL');
					}
				echo('</dd>');
			} 
		?>
		<dt><?php echo __('Resolution'); ?></dt>
		<dd>
			<?php echo h($debate['Debate']['resolution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Votes Gov'); ?></dt>
		<dd>
			<?php echo h($debate['Debate']['votes_gov']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Votes Opp'); ?></dt>
		<dd>
			<?php echo h($debate['Debate']['votes_opp']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
