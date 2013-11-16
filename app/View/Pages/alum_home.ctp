<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (Configure::read('debug') == 0):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>

<!--<p>You are 
<?php 
if ($currentUser['User']) {
	debug($currentUser['User']);
   echo "logged in as " . $currentUser['User']['display_name']  . " (" . $this->Html->link('logout', array('controller' => 'users', 'action' => 'logout')) . ")";
}else 
   echo "so not logged in (" . $this->Html->link('login', "/netbadge") . ")";
?></p>-->

<h2>
<div class="hero-unit">
<h1>Debatabase Alumni Homepage</h1>
<p>Please let me know if there's any information that you want to see here!</p>
</div>
</h2>
