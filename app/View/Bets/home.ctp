<h1>JQ Super Lotto</h1>
<div id="bets">
	<ul id="tabs">
		<li class="tab active" data-href="#content-bet">Start Betting</li>
		<li class="tab" data-href="#content-bets">Current Bets</li>
	</ul>
	<div class="grayblock">
		<div class="tabcontent active" id="content-bet">
			<?php if(!$cutoff) {  ?>
			<div class="pickblock">
				<h3>Please pick 6 digits below</h3>
				<span id="rem">Remaining: <var>6</var></span>
				<button id="btn-submit">Submit</button>
				<ul class="balls">
					<?php for($i = 1; $i <= 42; $i++) { ?>
					<li><?php echo $i; ?></li>
					<?php } ?>
				</ul>
			</div>
			<div class="sep"><span>OR</span></div>
			<div class="pickblock">
				<button id="btn-lucky">Lucky Pick</button>
			</div>
			<div id="picks"></div>
			<script type="text/javascript">
			var cint = setInterval(function() {
				var d = new Date();
				var n = d.getHours();
				if (n == 20) { location.reload(); }
			}, 300000);
			</script>
			<?php } else { ?>
			<div class="pickblock">
				<?php if(date('G') == 20) { ?>
				<div class="sep"><span>Betting is over, Results will be posted at 9pm.</span></div>
				<script type="text/javascript">
				var cint = setInterval(function() {
					var d = new Date();
					var n = d.getHours();
					if (n == 21) { location.reload(); }
				}, 300000);
				</script>
				<?php } else { ?>
				<div class="sep"><span>Results for <?php echo $drawdate; ?> raffle draw</span></div>
				<ul class="result">
					<?php for($i = 0; $i < count($result); $i++) { ?>
					<li><?php echo $result[$i]; ?></li>
					<?php } ?>

					<?php if(count($result) == 0) { ?>
					<p class="nocontent">No Lottery Draws</p>
					<?php } ?>
				</ul>
				<div class="sep-box">
					<div class="winners">
						<div class="jackpot">Jackpot Winner: <?php echo count($jackpot_winners); ?></div>
						<div class="fivedigit">5 Digit Combination Winner: <?php echo count($fivedigit_winners); ?></div>
					</div>
				</div>
				<script type="text/javascript">
				var cint = setInterval(function() {
					var d = new Date();
					var n = d.getHours();
					if (n == 8) { location.reload(); }
				}, 300000);
				</script>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
		<div class="tabcontent" id="content-bets">
			<div class="pickblock">
				<div class="sep"><span>Your bets for <?php echo $drawdate; ?> raffle draw</span></div>
				<ul class="betballs">
					<?php 
					$winnings = array();
					$class = '';
					
					foreach($active_bets as $bet):
					foreach($jackpot_winners as $winner) {
						similar_text($winner['Draw']['combination_sort'], $bet['Bet']['combination_sort'], $sim);
						$class = 'win-no';
						
						if($sim == 100) {
							$class = 'win-jackpot';
							array_push($winnings, 'Congratulations, you won the jackpot!');
						} else if($sim >= 87.5 && $sim <= 93.75) {
							$class = 'win-fivedigit';
							array_push($winnings, 'Congratulations, you won the 5-digit combination!');
						}
					}
					?>
					<li class="<?php echo $class; ?>">
					<?php 
					$betarr = split(',', $bet['Bet']['combination']);
					for($i = 0; $i < count($betarr); $i++) {
					?>
					<span><?php echo $betarr[$i]; ?></span>
					<?php } ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php
				if(!$active_bets) { 
					echo '<h3 class="bot no-bet">You dont have any bets yet!</h3>';
				} else {
					if ($winnings) {
						for($i = 0; $i < count($winnings); $i++) { 
							echo '<h3 class="bot">' . $winnings[$i] . '</h3>'; 
						} 
					} else { 
						if(!((date('G') >= 8) && (date('G') < 20))) {
							echo '<h3 class="bot no-bet">No win, better luck next time!</h3>';
						}
					}
				}
				?>
			</div>
		</div>
	</div>
	<div id="loader">
		<div class="loader-overlay"></div>
		<div class="loader-img"></div>
	</div>
</div>
<div id="footnote">*Betting is only available from 8am to 8pm. Raffle is drawn every 9pm.</div>