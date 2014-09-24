/**************
 * main.js
 **************/

$(document).ready(function() {
	$('.balls li').click(function() {
		selectPick($(this));
	});
	
	$('#btn-lucky').click(function() {
		luckyPick();
	});
	
	$('#btn-submit').click(function() {
		submitBet();
	});
	
	$('#tabs li').click(function() {
		var tab = $(this);
		switchTab(tab);
		
		return false;
	});
});