<div class="users form">
<?php echo $this->Form->create('User',array('action'=>'payDues', 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Enter Dues Payment'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('label' => array('class' => 'control-label')));
	?>
		<div class="control-group">
			<label for="UserPaymentTerm" class="control-label">PaymentTerm</label>
			<div class="controls">
				<select name="data[User][paymentTerm]" id="UserPaymentTerm">
					<option value="semester" selected="selected">Pay For The Semester</option>
					<option value="year">Pay For The Year</option>
				</select>
			</div>
		</div>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>