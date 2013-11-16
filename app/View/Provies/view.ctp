<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<?php echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom.css'); ?>

<script>
  $(function() {
	var pickerOpts = {
        dateFormat:"yy-mm-dd"
    }; 
	$( "#datepicker" ).datepicker(pickerOpts);
	$( "#meetings" ).accordion({
      heightStyle: "content",
	  collapsible: true,
	  active: false
    });
	$( "#points" ).accordion({
      heightStyle: "content",
	  collapsible: true,
	  active: false
    });
	$( "#tabs" ).tabs();
  });
</script>

<div class="provies view">
<h2><?php  echo __($provy['User']['display_name']); ?></h2>
	<dl class="dl-horizontal">
		<!--
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($provy['Provy']['id']); ?>
			&nbsp;
		</dd>
		-->
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($provy['User']['display_name'], array('controller' => 'users', 'action' => 'view', $provy['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Big Sib'); ?></dt>
		<dd>
			<?php if(isset($provy['Provy']['big_id'])){
				echo $this->Html->link($users[$provy['Provy']['big_id']], array('controller' => 'users', 'action' => 'view', $provy['Provy']['big_id']));
			} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendance'); ?></dt>
		<dd>
			<div id="meetings">
			<h3><?php echo($provy['Provy']['attendance'] . " (Click For More Details)");?></h3>
			<div>
			<?php 
			echo("You Were Marked Present At:</br>");?>
			<table class="table table-hover">
			<tr>
			<th>Meeting</th>
			<th>Roll Call Name</th>
			<th>Value</th>
			</tr>
			<?php
			foreach($rollCallsPresent as $meeting){
				echo('<tr>');
				if($meeting['meetings']['parent_id'] != null){
					echo('<td>' . $allMeetings[$meeting['meetings']['parent_id']] . "</td><td>"  . $meeting['meetings']['title'] . "</td><td>" . $meeting['meetings']['value'] . "</td>");
				}else{
					echo('<td>' . $meeting['meetings']['title'] . "</td><td>First Roll Call</td><td> " . $meeting['meetings']['value'] . "</td>");
				}
				echo('</tr>');
			}?>
			</table>
			</div>
			</div>
		</dd>
		<dt><?php echo __('Service To Sarge'); ?></dt>
		<dd>
			<?php if(h($provy['Provy']['service_to_sarge'])){
				echo("completed");
			}else{
				echo("not yet completed");
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service To Officer'); ?></dt>
		<dd>
			<?php if(h($provy['Provy']['service_to_officer'])){
				echo("completed");
			}else{
				echo("not yet completed");
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Debate'); ?></dt>
		<dd>
			<?php if(isset($provy['Debate']['id'])){
			echo $this->Html->link($provy['Debate']['resolution'], array('controller' => 'debates', 'action' => 'view', $provy['Debate']['id'])); 
			}else{
				echo("not yet completed");
			}?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lit'); ?></dt>
		<dd>
			<?php if(isset($provy['Lit']['title'])){
				echo $this->Html->link($provy['Lit']['title'], array('controller' => 'lits', 'action' => 'view', $provy['Lit']['id'])); 
			}else{
				echo("not yet completed");
			}?>
			&nbsp;
		</dd>
		<dt><?php echo __('Points'); ?></dt>
		<dd>
			<?php if(isset($provy['Provy']['Proviepoints'])){
				echo("<div id='points'>");
				echo("<h3>" . $provy['Provy']['Proviepoints'] . " (Click For More Details)</h3>");
			?>
			<div>
			<?php 
			echo("You Received Points For:</br>");?>
			<table class="table table-hover">
			<tr>
			<th>Points Given By</th>
			<th>Value</th>
			<th>Reason</th>
			</tr>
			<?php
			//die(var_dump($proviePointsReceived));
			foreach($proviePointsReceived as $point){
				echo('<tr>');
					echo('<td>' . $users[$point['provies_points']['giver_id']] . "</td><td>"  . $point['provies_points']['value'] . "</td><td>" . $point['provies_points']['reason'] . "</td>");
				echo('</tr>');
			}?>
			</table>
			</div>
			</div>
			<?php
			}else{
				echo("none yet");
			}?>
		</dd>
		<dt><?php echo __('Dues'); ?></dt>
		<dd>
			<?php if(strtotime($provy['User']['dues_expire']) > strtotime(date('Y-m-d'))){
				echo("Paid");
			}else{
				echo("not yet paid");
			}?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Inductions Elligible'); ?></dt>
		<dd>
			<?php if($provy['Provy']['inductions_elligible']){echo("yes");}else{echo("no");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($provy['Provy']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($provy['Provy']['modified']); ?>
			&nbsp;
		</dd>-->
	</dl>
</div>
<?php if($currentUser['Officer']){ ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provy'), array('action' => 'edit', $provy['Provy']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Provy'), array('action' => 'delete', $provy['Provy']['id']), null, __('Are you sure you want to delete # %s?', $provy['Provy']['id'])); ?> </li>
	</ul>
</div>
<?php } ?>
