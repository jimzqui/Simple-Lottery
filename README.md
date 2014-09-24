# Simple Lottery v1.0

This project is a simple lottery system with a game client, game server
and daily raffle draw.

* Author: Jimbo Quijano
* Homepage: jimboquijano.com
* Email: jimzqui@yahoo.com


## DATABASE

1. Export database dump from sql/ dir
2. Modify database settings in app/Config/database.php


## GAME CLIENT
There is no user sign-up. The app uses IP to associate each bet to a unique 
user. Users can bet as many times as they want.

Only the active bets are displayed in the UI. Once another betting session 
opens, all past bets will be removed in the UI. So every 8am, all bets in the
previous day will be cleared.

Every 8am to 8pm, users can see the betting UI and are able to bet manually 
or bet using the "lucky pick". The betting UI will be gone at 8pm onwards. 
Users will see a notice to wait for the result at 9pm. 

From 9pm onwards, users can see the results UI, the winning combination along 
with the number of winners. The system will notify the user if he win the 
jackpot or the 5-digit combination.


## GAME SERVER
A cron job will run everyday at 9pm. That cron job will run the "raffle draw" 
script automatically in the server. The "raffle draw" will create a 6-digit 
winning combination and store it in the database for reference. The system will 
check for winners of the jackpot and 5-digit combination.