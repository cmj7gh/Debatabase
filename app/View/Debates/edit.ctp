<div class="debates form">
<?php echo $this->Form->create('Debate', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Edit Debate Details'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('meeting_id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('resolution', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('votes_gov', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('votes_opp', array('label' => array('class' => 'control-label')));
	?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
	</form>
<?php //$this->Form->end(); ?>
<?php
		echo('<h2>');
		echo __('Edit Debaters');
		echo('</h2>');
		echo('<table class="table table-hover" cellpadding="0" cellspacing="0">');
		if(count($debaters)>0){
		foreach($debaters as $debater){
			echo('<tr>'); 
			echo('<td>');
			echo ($debater['Debater']['role']); 
			echo('</td>');
			echo('<td>');
				if(isset($debater['Debater']['user_id'])){
				 echo ($this->Html->link($users[$debater['Debater']['user_id']],array('controller'=>'users','action'=>'view',$debater['Debater']['user_id'])));	
				 }
			echo('</td><td class="actions">');
				 echo($this->Html->link(__('Remove'),array('controller'=>'debates','action'=>'removeDebater',$debater['Debater']['id']), array('class' => 'btn btn-small btn-danger')));
			echo('</td>');
		}
		}?>
		<tr><td>
		<?php
		echo $this->Form->create('Debate', array('controller'=>'debates','action' => 'addDebater', $id));
		$options = array('PM'=>'PM','LO'=>'LO','MG'=>'MG','MO'=>'MO');
		echo $this->Form->select('role',$options,array('empty'=>true));?>
		</td><td>
		<?php
		echo $this->Form->input('user_id',array('empty'=>true,'label'=>false));
		echo('</td><td class="actions">');
		echo $this->Form->end(__('Add Debater'));
		echo('</table>');
		
		echo $this->Form->create('Debate'); ?>
<?php echo $this->Form->postLink(__('Delete This Debate'), array('action' => 'delete', $this->Form->value('Debate.id')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Debate.id'))); ?>
</div>