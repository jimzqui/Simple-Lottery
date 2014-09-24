<?php

/**
 * Bets
 *
 * @package AppController
 */
class BetsController extends AppController {
	
	/**
     * Loads the bet model
     */
	public $uses = array('Bet', 'Draw', 'Winner');
	
	/**
	 * Display main page
	 *
	 * @return void
	 */
	public function home() {
		// Check if users are able to bet
		if((date('G') >= 8) && (date('G') < 20)) {
			$this->set('cutoff', false);
			
			// Set default result
			$result = false;
			$jackpot_winners = array();
			$fivedigit_winners = array();
		} else {
			$this->set('cutoff', true);
			
			// Get result
			$latest_draw = $this->Draw->latest();

			if (isset($latest_draw['Draw'])) {
				$combination = $latest_draw['Draw']['combination'];
				$result = split(',', $combination);

				// Get winners
				$jackpot_winners = $this->Winner->listing('jackpot', $latest_draw['Draw']['id']);
				$fivedigit_winners = $this->Winner->listing('fivedigit', $latest_draw['Draw']['id']);
			} 

			else {
				$result = null;
				$jackpot_winners = null;
				$fivedigit_winners = null;
			}
		}
		
		$this->set('result', $result);
		$this->set('jackpot_winners', $jackpot_winners);
		$this->set('fivedigit_winners', $fivedigit_winners);
		
		// Get draw date
		if((date('G') >= 0) && (date('G') < 8)) {
			$date = date('F j', time() - 60 * 60 * 24);
			$this->set('drawdate', $date);
		} else {
			$date = date('F j');
			$this->set('drawdate', $date);
		}
		
		// Get active bets
		$active_bets = $this->Bet->active($this->request->clientIp());
		$this->set('active_bets', $active_bets);
	}
	
	/**
	 * Add bet to the database
	 *
	 * @return object
	 */
	public function addbet() {
		// Dont render view
		$this->autoRender = false;
		
		// Add bet
		$selected = $this->data['selected'];
		$selected_sort = $selected;
		asort($selected_sort);
		$added = $this->Bet->add(array(
			'ip' => $this->request->clientIp(),
			'luckypick' => $this->data['luckypick'],
			'combination' => implode(',', $selected),
			'combination_sort' => implode(',', $selected_sort),
		));
		
		// Return result
		if ($added) {
			echo json_encode(array('result' => true));
		} else {
			echo json_encode(array('result' => false));
		}
	}
	
	/**
	 * Raffle draw
	 *
	 * @return object
	 */
	public function raffle() {
		// Dont render view
		$this->autoRender = false;
		
		// Set a pool of numbers from 1 to 42
		$pool = array();
		for($i = 1; $i <= 42; $i++) {
			array_push($pool, $i);
		}
		
		// Create new pool for the selected digits
		$selected = array();
		
		do {
		// Randomly pick a digit in the pool
		$rand = array_rand($pool, 1);
		$digit = $pool[$rand];
		array_push($selected, $digit);
		$selected = array_unique($selected);
		
		// Remove the selected one
		$key = array_search($digit, $pool);
		unset($pool[$key]);
		} while(count($selected) < 6);
		
		var_dump($selected);
		
		// Add result to the database
		$selected_sort = $selected;
		asort($selected_sort);
		$draw = $this->Draw->add(array(
			'combination' => implode(',', $selected),
			'combination_sort' => implode(',', $selected_sort)
		));
		
		// Get winners
		$jackpot_winners = $this->Bet->jackpot(implode(',', $selected_sort));
		$fivedigit_winners = $this->Bet->fivedigit(implode(',', $selected_sort));
		
		// Add jackpot winners
		foreach($jackpot_winners as $winner) {
			$this->Winner->add(array(
				'bet_id' => $winner['Bet']['id'],
				'draw_id' => $draw['Draw']['id'],
				'type' => 'jackpot'
			));
		}
		
		// Add fivedigit winners
		foreach($fivedigit_winners as $winner) {
			$this->Winner->add(array(
				'bet_id' => $winner['Bet']['id'],
				'draw_id' => $draw['Draw']['id'],
				'type' => 'fivedigit'
			));
		}
	}
  
}