<div class="provies form">
<?php echo $this->Form->create('Provy', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<h1 class="text-center"><?php echo __('Edit Provie: '. $users[$this->request->data['Provy']['user_id']]); ?></h1>
		<div class="control-group">
			<div class="controls">
				<?php echo $this->Html->link(__('Edit Biographical Information'), array('controller'=>'users', 'action' => 'edit', $this->request->data['Provy']['user_id']), array('class' => 'btn btn-large btn-info')); ?>
			</div>
		</div>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		if($currentUser['User']['office'] != null){
		echo $this->Form->input('big_id', array('label' => array('class' => 'control-label'),'empty'=>true));
		}else{
		echo $this->Form->input('big_id', array('label' => array('class' => 'control-label'),'empty'=>true, 'disabled'=> 'disabled'));
		}		
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Provy][service_to_sarge]" id="ProvyServiceToSarge_" value="0">
				<input type="checkbox" name="data[Provy][service_to_sarge]" value="1" <?php if($this->request->data['Provy']['service_to_sarge']){echo('checked');}?> id="ProvyServiceToSarge"> Service To The Sarge
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Provy][service_to_officer]" id="ProvyServiceToOfficer_" value="0">
				<input type="checkbox" name="data[Provy][service_to_officer]" value="1" <?php if($this->request->data['Provy']['service_to_officer']){echo('checked');}?> id="ProvyServiceToOfficer"> Service To Another Officer
			  </label>
			</div>
		</div>
	<?php
		echo $this->form->input('_App.referer', array('value' => $referer, 'type' => 'hidden')); 
		echo $this->Form->input('debate_id', array('label' => array('class' => 'control-label'), 'disabled'=> 'disabled', 'empty'=>true));
		echo $this->Form->input('lit_id', array('label' => array('class' => 'control-label'), 'disabled'=> 'disabled', 'empty'=>true));
		echo $this->Form->input('points', array('label' => array('class' => 'control-label'), 'disabled'=> 'disabled'));
	?>
		<!--<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Provy][inductions_elligible]" id="ProvyInductionsElligible_" value="0">
				<input type="checkbox" name="data[Provy][inductions_elligible]" value="1" <?php if($this->request->data['Provy']['inductions_elligible']){echo('checked');}?> id="ProvyInductionsElligible"> Inductions Elligible
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Provy][is_active]" id="ProvyIsActive_" value="0">
				<input type="checkbox" name="data[Provy][is_active]" value="1" <?php if($this->request->data['Provy']['is_active']){echo('checked');}?> id="ProvyIsActive"> Active
			  </label>
			</div>
		</div>-->
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>
