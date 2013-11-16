<?php
echo $this->Html->script('bootstrap-datepicker');
echo $this->Html->css('datepicker');

function createDatePicker($model, $name, $ModelName)
{
   $date = $model[$ModelName][$name];
   echo '<div class="controls">';
      echo '<div class="input-append date" id="dp_'.$name.'" data-date="'.$date.'" data-date-format="yyyy-mm-dd">';
      echo '<input class="span2" name="data['.$ModelName.']['.$name.']" size="20" value="'.$date.'">';
      echo '<span class="add-on"><i class="icon-calendar"></i></span>';
      echo '</div>';
   echo '</div>';
   echo '<script>$("#dp_'.$name.'").datepicker();</script>';
}

?>

<div class="meetings form">
<?php echo $this->Form->create('Meeting', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => '')));
?>
	<fieldset>
		<legend><?php echo __('Edit Meeting'); ?></legend>
	<?php
		echo $this->Form->input('title', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		//echo $this->Form->input('datetime', array('label' => array('class' => 'control-label')));
		echo '<div class="control-group">';
			echo $this->Form->label('Meeting.datetime', null, array('class' => 'control-label'));
			createDatePicker($this->request->data, 'datetime', 'Meeting');
		echo '</div>';
		echo $this->Form->input('value', array('label' => array('class' => 'control-label')));
		//echo $this->Form->input('User');
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

