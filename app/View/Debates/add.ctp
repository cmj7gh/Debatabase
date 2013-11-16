<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<script>
	$( function() {
		var field_count = 5;
		$("#link_id").click(function(){
			//$("#div_addfield").append( '<tr><td><input type="text" name="data[User][field][' + field_count + ']" /></tr></td>' );
			//field_count++;
			var MembersSelectElement = document.createElement("select");
			MembersSelectElement.name = "data[debaters]["+field_count+"][user_id]";
			var Useropt = document.createElement("option");
			Useropt.value='';
			Useropt.innerHTML='';
			MembersSelectElement.appendChild(Useropt);
			<?php
			foreach($Allusers as $key=>$value){
				echo('var Useropt = document.createElement("option");');
				echo('Useropt.value="'.$key.'";');
				echo('Useropt.innerHTML="'.$value.'";');
				echo('MembersSelectElement.appendChild(Useropt);');
			}
			?>
			var table = document.getElementById('debatersTable');
			var rowCount = table.rows.length;
			var row = table.insertRow(2);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var element1 = document.createElement("select");
			element1.name = "data[debaters]["+field_count+"][role]";
			var MGopt = document.createElement("option");
			MGopt.value='MG';
			MGopt.innerHTML ='MG';
			element1.appendChild(MGopt);
			var PMopt = document.createElement("option");
			PMopt.value='PM';
			PMopt.innerHTML ='PM';
			element1.appendChild(PMopt);
			var MOopt = document.createElement("option");
			MOopt.value='MO';
			MOopt.innerHTML ='MO';
			element1.appendChild(MOopt);
			var LOopt = document.createElement("option");
			LOopt.value='LO';
			LOopt.innerHTML ='LO';
			element1.appendChild(LOopt);
			var NULLopt = document.createElement("option");
			NULLopt.value='';
			NULLopt.innerHTML ='';
			element1.appendChild(NULLopt);
			cell1.appendChild(element1);
			cell2.appendChild(MembersSelectElement);
			
			var MembersSelectElement = document.createElement("select");
			MembersSelectElement.name = "data[debaters]["+(field_count+1)+"][user_id]";
			var Useropt = document.createElement("option");
			Useropt.value='';
			Useropt.innerHTML='';
			MembersSelectElement.appendChild(Useropt);
			<?php
			foreach($Allusers as $key=>$value){
				echo('var Useropt = document.createElement("option");');
				echo('Useropt.value="'.$key.'";');
				echo('Useropt.innerHTML="'.$value.'";');
				echo('MembersSelectElement.appendChild(Useropt);');
			}
			?>			
			var row = table.insertRow(rowCount+1);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var element1 = document.createElement("select");
			element1.name = "data[debaters]["+(field_count+1)+"][role]";
			var MOopt = document.createElement("option");
			MOopt.value='MO';
			MOopt.innerHTML ='MO';
			element1.appendChild(MOopt);
			var PMopt = document.createElement("option");
			PMopt.value='PM';
			PMopt.innerHTML ='PM';
			element1.appendChild(PMopt);
			var MGopt = document.createElement("option");
			MGopt.value='MG';
			MGopt.innerHTML ='MG';
			element1.appendChild(MGopt);
			var LOopt = document.createElement("option");
			LOopt.value='LO';
			LOopt.innerHTML ='LO';
			element1.appendChild(LOopt);
			var NULLopt = document.createElement("option");
			NULLopt.value='';
			NULLopt.innerHTML ='';
			element1.appendChild(NULLopt);
			cell1.appendChild(element1);
			cell2.appendChild(MembersSelectElement);
			
			field_count = field_count+2;
		});
    });
</script>
<div class="debates form">
<?php echo $this->Html->link(__('If The Debater Is Not Yet In The Debatabase, Click Here To Add Them First'), array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-info')); ?>
<?php echo $this->Form->create('Debate', array('action'=>'add/'.$meetingId, 'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add Debate'); ?></legend>
	<?php
		echo $this->Form->input('meeting_id', array('default' => $meetingId, 'label' => array('class' => 'control-label')));
		echo $this->Form->input('resolution', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('votes_gov', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('votes_opp', array('label' => array('class' => 'control-label')));
		echo('<table id="debatersTable" cellpadding="0" cellspacing="0">');
		echo('<tr><td>');
		$options = array('PM'=>'PM','LO'=>'LO','MG'=>'MG','MO'=>'MO');
		echo $this->Form->select('debaters.1.role',$options,array('default'=>'PM'));
		echo('</td><td>');
		echo $this->Form->select('debaters.1.user_id',$users,array('empty'=>true,'label'=>false));
		echo('</td></tr>');
		echo('<tr><td>');
		echo $this->Form->select('debaters.2.role',$options,array('default'=>'MG'));
		echo('</td><td>');
		echo $this->Form->select('debaters.2.user_id',$users,array('empty'=>true,'label'=>false));
		echo('</td></tr>');
		echo('<tr><td>');
		echo $this->Form->select('debaters.3.role',$options,array('default'=>'LO'));
		echo('</td><td>');
		echo $this->Form->select('debaters.3.user_id',$users,array('empty'=>true,'label'=>false));
		echo('</td></tr>');
		echo('<tr><td>');
		echo $this->Form->select('debaters.4.role',$options,array('default'=>'MO'));
		echo('</td><td>');
		echo $this->Form->select('debaters.4.user_id',$users,array('empty'=>true,'label'=>false));
		echo('</td></tr>');?>
		<div id='div_addfield'>
			<a id='link_id' class='btn btn-info'>Not Enough Spaces? Add A Debater To Each Team</a>
		</div>
	<?php	echo('</table>');
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
