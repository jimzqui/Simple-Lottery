<?php

/**
 * Winner
 *
 * @package AppModel
 */
class Winner extends AppModel {
	
	/**
	 * Winner relationships
	 */
	public $belongsTo = array('Bet', 'Draw');
	
	/**
	 * Add winner
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function add($data) {
		$this->create();
		return $this->save($data);
	}
	
	/**
	 * Get winners by $type
	 *
	 * @param string $type
	 * @return mixed
	 */
	public function listing($type, $draw_id) {
		return $this->find('all', array(
			'conditions' => array(
				'Winner.type' => $type,
				'Winner.draw_id' => $draw_id
			)
		));
	}
	
}
