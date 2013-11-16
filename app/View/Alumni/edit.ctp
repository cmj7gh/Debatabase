<div class="alumni form">
<?php echo $this->Form->create('Alumnus', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<h1 class="text-center"><?php echo __('Edit Alumnus: '. $users[$this->request->data['Alumnus']['user_id']]); ?></h1>
		<div class="control-group">
			<div class="controls">
				<?php echo $this->Html->link(__('Edit Biographical Information'), array('controller'=>'users', 'action' => 'edit', $this->request->data['Alumnus']['user_id']), array('class' => 'btn btn-large btn-info')); ?>
			</div>
		</div>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->form->input('_App.referer', array('value' => $referer, 'type' => 'hidden')); 
		echo $this->Form->input('current_address', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('grad_school', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('industry', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('company', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('position', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('show_who', array('label' => array('class' => 'control-label'), 'type'=>'select','options'=>array('all'=>'All Washies','alumni'=>'Only Other Alumni And The Alumni Chair','chair'=>'Only The Alumni Chair')));
	?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>
