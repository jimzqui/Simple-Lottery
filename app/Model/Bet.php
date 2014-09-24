<?php

/**
 * Bet
 *
 * @package AppModel
 */
class Bet extends AppModel {
	
	/**
	 * Add bet
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function add($data) {
		$this->create();
		return $this->save($data);
	}
	
	/**
	 * Get active bets
	 *
	 * @param string $ip
	 * @return array
	 */
	public function active($ip) {
		$date = $this->raffleDate();
		
		return $this->find('all', array(
			'conditions' => array(
				'Bet.ip' => $ip,
				'and' => array('Bet.created >= ' => $date['start_date'], 'Bet.created <= ' => $date['end_date'])
			)
		));
	}
	
	/**
	 * Check jackpot winners
	 *
	 * @param string $result
	 * @return array
	 */
	public function jackpot($result) {
		$date = $this->raffleDate();
	
		return $this->find('all', array(
			'conditions' => array(
				'Bet.combination_sort' => $result,
				'and' => array('Bet.created >= ' => $date['start_date'], 'Bet.created <= ' => $date['end_date'])
			)
		));
	}
	
	/**
	 * Check fivedigit winners
	 *
	 * @param string $result
	 * @return array
	 */
	public function fivedigit($result) {
		$date = $this->raffleDate();
		
		$prospects = $this->find('all', array(
			'conditions' => array(
				'and' => array('Bet.created >= ' => $date['start_date'], 'Bet.created <= ' => $date['end_date'])
			)
		));
		
		$winners = array();
		foreach($prospects as $prospect) {
			$combination = $prospect['Bet']['combination_sort'];
			similar_text($result, $combination, $sim);
			if($sim >= 87.5 && $sim <= 93.75) {
				array_push($winners, $prospect);
			}
		}
		
		return $winners;
	}
	
	/**
	 * Get current raffle date
	 *
	 * @return array
	 */
	public function raffleDate() {
		if((date('G') >= 0) && (date('G') < 8)) {
			$date = date('Y-m-d', time() - 60 * 60 * 24);
		} else {
			$date = date('Y-m-d');
		}
	
		$start_date = $date . ' 08:00:00';
		$end_date = $date . ' 20:00:00';
		
		return array(
			'start_date' => $start_date,
			'end_date' => $end_date
		);
	}
	
}
