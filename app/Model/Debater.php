<?php
App::uses('AppModel', 'Model');
/**
 * Debater Model
 *
 * @property Debate $Debate
 * @property User $User
 */
class Debater extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Debate' => array(
			'className' => 'Debate',
			'foreignKey' => 'debate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);
}
