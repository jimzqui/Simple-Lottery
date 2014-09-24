<?php

/**
 * Draw
 *
 * @package AppModel
 */
class Draw extends AppModel {
	
	/**
	 * Model relationships
	 */
	public $hasOne = array('Winner');
	
	/**
	 * Add draw
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function add($data) {
		$this->create();
		return $this->save($data);
	}
	
	/**
	 * Get latest draw
	 *
	 * @return array
	 */
	public function latest() {
		return $this->find('first', array(
			'order' => array('Draw.id DESC'),
			'recursive' => -1
		));
	}
	
}
