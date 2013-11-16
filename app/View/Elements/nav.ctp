<div class="navbar navbar-inverse navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
         <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </a>
		<?php
		if(isset($currentUser)){
			if($currentUser['User']['role'] == 'provie'){
				echo($this->Html->link("Home", array('controller' => 'provies', 'action' => 'view', $currentUser['Provie']['Provy']['id']), array('class' => 'brand')));	
			}elseif($currentUser['User']['office'] != null){
				echo($this->Html->link("Home", array('controller' => 'pages', 'action' => 'officer_home'), array('class' => 'brand')));
			}elseif($currentUser['User']['role'] == 'member'){
				echo($this->Html->link("Home", array('controller' => 'pages', 'action' => 'member_home'), array('class' => 'brand')));
			}elseif($currentUser['User']['role'] == 'alum'){
				echo($this->Html->link("Home", array('controller' => 'pages', 'action' => 'alum_home'), array('class' => 'brand')));
			}else{
				echo($this->Html->link("Home", '/', array('class' => 'brand')));
				//echo( "<h1>" . $this->Html->link($cakeDescription, '/') . "<h1>");	
			}
		}
		?>
         <div class="nav-collapse collapse">
            <ul class="nav">
				<?php if(isset($currentUser['User']['office']) && ($currentUser['User']['office'] != null)){ ?>
               <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Officer Functions <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(('Take Attendance'), array('controller' => 'users', 'action' => 'takeAttendance')); ?></li>
						<li><?php echo $this->Html->link(__('Pay Dues'), array('controller' => 'users', 'action' => 'payDues')); ?></li>
						<li><?php echo $this->Html->link(__('Give Provie Points'), array('controller' => 'provies', 'action' => 'givePoints')); ?></li>
						<li><?php echo $this->Html->link(__('Register Provies @ SOTR'), array('controller' => 'provies', 'action' => 'signTheRoll')); ?></li>
						<?php if($currentUser['User']['office'] == 'webmaster'){ ?>
							<li><?php echo $this->Html->link(__('List Authentications'), array('controller' => 'authentications', 'action' => 'index')); ?> </li>
							<li><?php echo $this->Html->link(__('List Logs'), array('controller' => 'logs', 'action' => 'index')); ?> </li>
							<li><?php echo $this->Html->link(__('List Settings'), array('controller' => 'settings', 'action' => 'index')); ?> </li>
						<?php }elseif($currentUser['User']['office'] == 'alumnichair'){ ?>
							<li><?php echo $this->Html->link(__('List Alumni'), array('controller' => 'alumni', 'action' => 'index')); ?> </li>
						<?php } ?>
					</ul>
			   </li>
			   <?php } ?>
			   <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">List Washies <b class="caret"></b></a>
			   <ul class="dropdown-menu">
               <li><?php echo $this->Html->link(__('List Members'), array('controller' => 'users', 'action' => 'index')); ?></li>
			   <?php if(isset($currentUser['User']) and ($currentUser['User']['role']!= null)){ ?>
               <li><?php echo $this->Html->link(__('List Provies'), array('controller' => 'provies', 'action' => 'index')); ?></li>
			   <li><?php echo $this->Html->link(__('List Alumni'), array('controller' => 'alumni', 'action' => 'index')); ?></li>
			   <?php } ?>
			   </ul>
			   </li>
			   <?php if(isset($currentUser['User']) and ($currentUser['User']['role']!= null)){ ?>
			   <li><?php echo $this->Html->link(__('List Lits'), array('controller' => 'lits', 'action' => 'index')); ?> </li>
			   <li><?php echo $this->Html->link(__('List Debates'), array('controller' => 'debates', 'action' => 'index')); ?></li>
			   <?php } ?>
			   <li><?php echo $this->Html->link(__('List Meetings'), array('controller' => 'meetings', 'action' => 'index')); ?></li>
            </ul>	
			
			<?php if (isset($currentUser['User']))
			   { 
					//var_dump($currentUser);
				 echo '<ul class="nav pull-right">
					<li class="dropdown">
					   <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$currentUser['User']['display_name'].' <b class="caret"></b></a>
					   <ul class="dropdown-menu">';
					   if($currentUser['User']['role']=='alum'){
							echo '<li>' . $this->Html->link("Edit Your Profile", array('controller' => 'alumni', 'action' => 'edit', $currentUser['Alum']['Alumnus']['id'])) .'</li>';
					   }else{
							echo '<li>' . $this->Html->link("Edit Your Profile", array('controller' => 'users', 'action' => 'edit', $currentUser['User']['id'])) .'</li>';
						}
							echo '<li>'. $this->Html->link("Logout", array("controller" => "users", "action" => "logout")). '</li>
					   </ul>
					</li>
				 </ul>';
			   }
			   else
			   { 
				  //echo($this->Html->link('login', "/netbadge", array('class' => 'btn btn-info pull-right')));
				  //echo '<a class="btn btn-info pull-right" href="#">Login</a>'; ?>
				  <li class="dropdown"><a href="#" class="dropdown-toggle btn btn-info pull-right" data-toggle="dropdown">Login <b class="caret"></b></a>
				   <ul class="dropdown-menu pull-right">
				   <li><?php echo $this->Html->link(__('Use Netbadge'), "/netbadge"); ?></li>
				   <li><?php echo $this->Html->link(__('Alumni Without Netbadge'), array('controller' => 'users', 'action' => 'login')); ?></li>
				   </ul>
				   </li>
			   <?php } ?>
         </div>
      </div>
   </div>
</div>
