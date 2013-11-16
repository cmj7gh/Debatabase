<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<?php //echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom.css'); ?>
<?php echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom_edits_for_attendance.css'); ?>
<?php //var_dump($members); ?>
<!-- jQuery UI trial -->
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
	$( "#tabs" ).tabs({ active: 1 });
  });
</script>

<!--<form>
	<div id="format">
	  <input type="checkbox" id="check1" /><label for="check1">B</label>
	  <input type="checkbox" id="check2" /><label for="check2">I</label>
	  <input type="checkbox" id="check3" /><label for="check3">U</label>
	</div>
</form>-->

<form action="/~wash/users/takeAttendance" method="post" accept-charset="utf-8">
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Add To An Existing Meeting</a></li>
    <li><a href="#tabs-2">Create A New Meeting</a></li>
  </ul>
  <div id="tabs-1">
	<?php echo $this->Form->input('meeting_id', array('empty'=>true)); ?>
	<div class="input text">
		<label for="SubMeetingValue">Title For This Roll Call</label>
		<select name="SubMeetingTitle" id="SubMeetingTitle">
			<option value="7 PM Meeting">7 PM Meeting</option>
			<option value="8 PM Lits">8 PM Lits</option>
			<option value="8 PM Debate">8 PM Debate</option>
			<option value="Other">Other</option>
		</select>
	</div>
	<div class="input text">
		<label for="SubMeetingValue">Value For This RollCall</label>
		<input name="SubMeetingValue" type="text" value="0.5" id="SubMeetingValue"/>
	</div>
	</div>
	<div id="tabs-2">
	<div class="input text">
		<label for="MeetingValue">Meeting Title</label>
		<input name="title" type="text" value="Normal Meeting" id="MeetingTitle"/>
	</div>
	<label for="datepicker">Meeting Date</label>
	<input name="date" type="text" id="datepicker" value="<?php echo(date("Y-m-d")); ?>"/>
	<div class="input text">
		<label for="MeetingValue">Meeting Value</label>
		<input name="value" type="text" value="0.5" id="MeetingValue"/>
	</div>
	</div>
	</div>
	<input type="hidden" name="_method" value="PUT"/>
	<div id="accordion">
	<h3>Member Roll</h3>
	<div>
	<table>
	<?php 
		$count = 0;
		foreach($members as $m){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			echo('<input type="checkbox" name="User[]" value=' . $m['User']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $m['User']['first_name'] . ' ' . $m['User']['last_name'] . '</label>');
			echo('</td>');
			if($count % 3 == 2){
				echo('</tr>');
			}		
			$count++;
		}

	?>
	</table>
	</div>
	<h3>Provie Roll</h3>
	<div>
	<table>
	<?php 
		if($count %3 == 1){$count+=2;}
		if($count %3 == 2){$count++;}
		foreach($provies as $p){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			echo('<input type="checkbox" name="User[]" value=' . $p['User']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $p['User']['first_name'] . ' ' . $p['User']['last_name'] . '</label>');
			echo('</td>');
			if($count % 3 == 2){
				echo('</tr>');
			}		
			$count++;
		}

	?>
	</table>
	</div>
	</div>
<div class="submit"><input  type="submit" value="Submit"/></div>
</form>
<?php
		for($i = 0; $i <= $count; $i++){
			echo("<script>");
			echo("$(function() {");
			echo('$( "#check' . $i . '" ).button();');
			echo("  });</script>");
		}
?>
