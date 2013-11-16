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

<form action="/~wash/users/takeAttendance/<?php echo($roll_id);?>" method="post" accept-charset="utf-8">
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Editing Roll Call for <?php echo("Meeting: " . $thisMeeting['display_name']); ?></a></li>
  </ul>
  <div id="tabs-1">
	<div class="input text">
		<label for="SubMeetingValue">Title For This Roll Call</label>
		<select name="SubMeetingTitle" id="SubMeetingTitle">
			<option value="<?php echo($thisMeeting['title']);?>"><?php echo($thisMeeting['title']);?></option>
			<option value="7 PM Meeting" <?php if($thisMeeting['title'] == "7 PM Meeting"){echo('selected="selected"');}?>>7 PM Meeting</option>
			<option value="8 PM Lits" <?php if($thisMeeting['title'] == "8 PM Lits"){echo('selected="selected"');}?>>8 PM Lits</option>
			<option value="8 PM Debate" <?php if($thisMeeting['title'] == "8 PM Debate"){echo('selected="selected"');}?>>8 PM Debate</option>
			<option value="Other" <?php if($thisMeeting['title'] == "Other"){echo('selected="selected"');}?>>Other</option>
		</select>
	</div>
	<div class="input text">
		<label for="SubMeetingValue">Value For This RollCall</label>
		<input name="SubMeetingValue" type="text" value=<?php echo($thisMeeting['value']);?> id="SubMeetingValue"/>
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
		$nextIdInAttendance = $AttendingUsers;
		foreach($members as $m){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			$attended = false;
			foreach($AttendingUsers as $attendee){
				if($attendee['meetings_users']['user_id'] == $m['User']['id']){
					echo('<input type="checkbox" name="User[]" value=' . $m['User']['id'] . ' id="check' . $count .'" checked="checked"/><label for="check' . $count .'">' . $m['User']['first_name'] . ' ' . $m['User']['last_name'] . '</label>');
					$attended = true;
					break;
				}
			}
			if(!$attended){
				echo('<input type="checkbox" name="User[]" value=' . $m['User']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $m['User']['first_name'] . ' ' . $m['User']['last_name'] . '</label>');
			}
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
			$attended = false;
			foreach($AttendingUsers as $attendee){
				if($attendee['meetings_users']['user_id'] == $p['User']['id']){
					echo('<input type="checkbox" name="User[]" value=' . $p['User']['id'] . ' id="check' . $count .'" checked="checked"/><label for="check' . $count .'">' . $p['User']['first_name'] . ' ' . $p['User']['last_name'] . '</label>');
					$attended= true;
					break;
				}
			}			
			if(!$attended){
				echo('<input type="checkbox" name="User[]" value=' . $p['User']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $p['User']['first_name'] . ' ' . $p['User']['last_name'] . '</label>');
			}
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
