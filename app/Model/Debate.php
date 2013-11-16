<?php
App::uses('AppModel', 'Model');
/**
 * Debate Model
 *
 * @property Meeting $Meeting
 * @property User $Pm
 * @property User $Mg
 * @property User $Lo
 * @property User $Mo
 */
class Debate extends AppModel {
	public $displayField = 'resolution';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Meeting' => array(
			'className' => 'Meeting',
			'foreignKey' => 'meeting_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	public $hasMany = array(
		'Debater' => array(
			'className' => 'Debater',
			'foreignKey' => 'debate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
