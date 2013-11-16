<head>
	<title>Tasks</title>
	<?php echo $this->html->css(array('signTheRoll.css')); ?>
</head>

<div class="provies form">
<?php echo $this->Form->create('Provy',array('action'=>'signTheRoll', 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add Provy'); ?></legend>
	<?php
		for($i=0; $i<50; $i++){
			echo('<div class="controls controls-row">');
			echo('<input type="text" placeholder="First Name" class="span3" name="provies.'.$i.'.first_name" id="provies.'.$i.'.first_name">');
			echo('<input type="text" placeholder="Last Name" name="provies.'.$i.'.last_name" id="provies.'.$i.'.last_name">');
			echo('<div class="input-append">');
			echo('<input type="text" placeholder="Email" class="span2" name="provies.'.$i.'.Email" id="provies.'.$i.'.email">');
			echo('<span class="add-on">@virginia.edu</span>');
			echo('</div></div><hr></br>');
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>