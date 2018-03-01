<?php

#--------------------------CREATING DECK---------------------------------
#Creating an array for my deck and a loop that goes 
#through all the possible cards in the deck (52 possibilities).
$myDeck = array();
for ($i = 1; $i < 53; $i++) {
	array_push($myDeck, $i);
}
#------------------------------------------------------------------------

#---------------------INITIALIZING ARRAYS--------------------------------

#Creating array to store Points.
$myPoints = array();
#Creating array to store [4] Players.
$myPlayers = array();
#Creating array to store Hands.
$myHands = array();
#Creating empty array to store Winner.
$myWinner = array("", "", "", "");
#------------------------------------------------------------------------

#---------------------STARTING THE GAME ---------------------------------
#Function that calls for starting the game. 
function startGame() {
	
	global $myPlayers;
	#Running a loop that generates 
	for ($i = 0; $i < 4; $i++){
		#Function that creates 4 players with images and names and displays it.
		createPlayer($i);
		#Function that generates cards & returns an array of cards per player.
		getHand($i);
	}
	
	//WHAT WE ARE MISSING: 
	
	//randomizePlayers();
	
	//displayWinner();
}
#------------------------------------------------------------------------


#-------------------------CREATING PLAYER--------------------------------
#Function that creates 4 players based on the loop from startGame.
#Image number should go from 0 to 3 followed by .jpg
function createPlayer($imageNumber) {
	#Creating globlal variables so they can use it in myPlayers.
	global $myPlayers;
	#Temporal value that holds the IMAGE path to be displayed later on.
	$temp = "<img id='player'".$i."style='width:100px; margin:0 auto' src='img/players/" . $imageNumber . ".jpg'/>";
	#Pushing and storing image into myPlayers array to user later.
	array_push($myPlayers, $temp);
	#Shuffling myPlayers array.
	echo $myPlayers[$imageNumber];
}
#------------------------------------------------------------------------

#-----------------------DISPLAYING PLAYERS-------------------------------
#Function that displays 4 players in different position each time.
function randomizePlayers(){

	#We should figure out how to display players in a random way everytime
	#we refresh the page.

}
#------------------------------------------------------------------------

#-----------------------DISPLAYING WINNER--------------------------------
#Function that displays winner o winner(s) by adding up the totalPoints from each player.
function displayWinner(){

	global $myPoints;
	global $myPlayers;
	global $myHands;
	
	#We should calculate the points from each row and display who is the winner.

}
#------------------------------------------------------------------------



#-----------------------GENERATING A HAND--------------------------------
#Function to generate a random hand for each player. 
# Passing array $myPlayers as an argument.
function getHand($playerNumber) {
	
	#Creating global variables, so they can be used in this function.
	global $myDeck;
	global $myPoints;
	global $myHands;
	
	#Creating an array to store the 4 suits of the deck for the PATHWAY.
	$mySuits = array("clubs", "diamonds", "hearts", "spades");
	
	#Creating a flag to control the while loop.
	$flag = true;
	
	#Shuffling all my cards before entering the while loop, so it is random.
	shuffle($myDeck);

	#While each player's hand doesn't go over 42.
	while($flag) {
		
		#Popping the last card from the Deck which will be the chosen one.
		$lastCard = array_pop($myDeck);
		#Selecting what number the card will be (% 13).
		$cardNumber = $lastCard % 13;
		#myPoints array[index of the Player (total of 4 players] adding the points everytime.
		$totalPoints += $cardNumber;
		
		#When cardNumber is 0 that means that is the King or 13.
		if($cardNumber == 0)
		{
			#Storing the hand into a temporal value to be used later on.
			$cardNumber = 13;
		}
		
		#Storing the picture into tempHand variable.
		$tempHand = "<img id='cards' style='width:100px;' src='img/". $mySuits[ceil($lastCard / 13) - 1]."/" . $cardNumber . ".png'/>";
		
		#Creating eachHand array to store each Hand for each player. Meaning 4 hands for 4 players.
		$eachHand = array();
		#Pushing the temporal hand Image (could be 4,5,6,7,8,9 in a hand) times 4 rows for 4 players into eachHand array.
		array_push($eachHand, $tempHand);
		
		#Displaying the cards.
		echo $tempHand;
		
		#If the totalPoints counted are 42 or greater than 42, then jump out of the while loop.
		if($totalPoints >= 42)
		{
			#Jumping out of the while loop.
			$flag = false;
		}
	}
	
	#Displaying the total Points.
	echo "Total Points: " . $totalPoints; echo "<br>";
	
	#myPoints array now holds all the values for each player.
	#so myPlayers[0] will correspond to myPoints[0], same for [1],[2],[3].
	#so we can store all the points here from each player for later using the sessions.
	$myPoints[$playerNumber] = $totalPoints;

}
#------------------------------------------------------------------------

?>