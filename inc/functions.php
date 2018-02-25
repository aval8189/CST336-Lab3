
<?php

#Creating an array for my deck and a loop that goes 
#through all the possible cards in the deck (52 possibilities).
$myDeck = [];
for ($i = 0; $i < 52; $i++) {
	$myDeck[] = $i;
}

#Using the array function to shuffle the deck that we will be using.
shuffle($deck);


#---------------------INITIALIZING ARRAYS--------------------------------
#Creating array to store Points.
$myPoints = array(0, 0, 0, 0);
#Creating array to store Players.
$myPlayers = [];
#Creating array to store Hands.
$myHands = [];
#Creating empty array to store Winner.
$myWinner = array("", "", "", "");
#------------------------------------------------------------------------



#---------------------STARTING THE GAME ---------------------------------
#Function that calls for starting the game. 
function startGame() {
	#Running a loop that generates 
	for ($i = 0; $i < 4; $i++){
		#Function that creates 4 players with images and names.
		createPlayer($i);
		#Function that generates cards & returns an array of cards per player.
		getHand($i);
	}
	
	#Displays the array of cards per player along with the sum of points.
	displayHand();
	
	#Display a winner based on the hands for each player.
	#	Display winner(s) along with points obtained.
	displayWinners();
	
}
#------------------------------------------------------------------------


#-----------------------GENERATING A HAND--------------------------------
#Function to generate a random hand for each player. 
# Passing array $myPlayers as an argument.
function getHand($myPlayers) {
	
	#Creating global variables, so they can be used in this function.
	global $myDeck;
	global $myPoints;
	global $myHands;
	
	#Length of how many cards we want a hand to have being chosen randomly.
	#Integers between 4 and 6.
	$lengthCards = rand(4, 6);
	
	#Iterating up the length of cards.
	for ($i = 0; $i < $lengthCards; $i++) {
		
		#Popping the last card so we can use it later.
		$lastCard = array_pop($myDeck);
		#Creating an array to store the 4 suits of the deck.
		$mySuits = array("clubs", "diamonds", "hearts", "spades");
		#Selecting what number the card will be.
		$cardNumber = (($lastCard % 13) + 1);
		#Storing the cardNumber into $myPoints, so we can calculate the number 
		#	of points later on.
		$myPoints[$myPlayers] += $cardNumber;
		#Storing the hand into a temporal value to be used later on.
		$tempHand = "<img src= 'cards/" . $mySuits[floor($lastCard / 13)] . "/" . $cardNumber . ".png'/>";
		#Pushing the temporal value with the path of the card image into $myHands array.
		array_push($myHands, $tempHand);
	}
	#Store 0 into $myHands to keep track of when the new hand starts.
	array_push($myHands, "0");
}
#------------------------------------------------------------------------


?>