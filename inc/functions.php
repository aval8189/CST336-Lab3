<?php

$_SESSION['sessions'];
$averagetime = array();
$_SESSION['averagetime'];//= $averagetime;
//array_push($averagetime, $_SESSION['averagetime']);
session_start();



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

#creating a few arrays to house all cards.
$allHands = array(); 
$player1 = array();
$player2 = array();
$player3 = array();
$player4 = array();

#Creating empty array to store Winner.
$myWinner = array("", "", "", "");
#------------------------------------------------------------------------

#---------------------STARTING THE GAME ---------------------------------
#Function that calls for starting the game. 
function startGame() 
{
	//starting the micro time counter
	$start = microtime(true);
	
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
	$temp = "<img id='player'".$imageNumber."style='width:100px; margin:0 auto' src='img/players/" . $imageNumber . ".jpg'/>";
	#Pushing and storing image into myPlayers array to user later.
	array_push($myPlayers, $temp);
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
	
	#allowing the arrays for players to be used
	global $allHands;
	global $player1;
	global $player2;
	global $player3;
	global $player4;
	
	#Creating an array to store the 4 suits of the deck for the PATHWAY.
	$mySuits = array("clubs", "diamonds", "hearts", "spades");
	
	#Creating a flag to control the while loop.
	$flag = true;
	
	#Shuffling all my cards before entering the while loop, so it is random.
	shuffle($myDeck);

	#While each player's hand doesn't go over 42.
	while($flag) {
		
		$pictemp = "<img id='player'".$playerNumber."style='width:100px; margin:0 auto' src='img/players/" . $playerNumber . ".jpg'/>";
		#Popping the last card from the Deck which will be the chosen one.
		$lastCard = array_pop($myDeck);
		#Selecting what number the card will be (% 13).
		$cardNumber = $lastCard % 13;
		#myPoints array[index of the Player (total of 4 players] adding the points everytime.
		if($cardNumber == 0)
		{
			$totalPoints +=13;
		}
		else
		{
			$totalPoints += $cardNumber;
		}
		#When cardNumber is 0 that means that is the King or 13.
		if($cardNumber == 0)
		{
			#Storing the hand into a temporal value to be used later on.
			$cardNumber = 13;
		}
		
		#Storing the picture into tempHand variable.
		$tempHand = "<img class='cards' style='width:100px;' src='img/". $mySuits[ceil($lastCard / 13) - 1]."/" . $cardNumber . ".png'/>";
		
		#Creating eachHand array to store each Hand for each player. Meaning 4 hands for 4 players.
		#Pushing the temporal hand Image (could be 4,5,6,7,8,9 in a hand) times 4 rows for 4 players into eachHand array.
		
		if($playerNumber == 0)
		{
			array_push($player1,$tempHand);
		}
		if($playerNumber == 1)
		{
			array_push($player2, $tempHand);
		}
		if($playerNumber == 2)
		{
			array_push($player3, $tempHand);
		}
		if($playerNumber == 3)
		{
			array_push($player4, $tempHand);
		}
		
		#Displaying the cards.
		
		//echo $tempHand;
		
		#If the totalPoints counted are 42 or greater than 42, then jump out of the while loop.
		if($totalPoints == 36 || $totalPoints >= 42)
		{
			if($playerNumber == 0)
			{
				array_unshift($player1,$pictemp);
				
				array_push($player1,$totalPoints);
				array_push($allHands,$player1);
			}
			
			if($playerNumber == 1)
			{
				array_unshift($player2,$pictemp);
				array_push($player2,$totalPoints);
				array_push($allHands,$player2);
			}
			
			if($playerNumber == 2)
			{
				array_unshift($player3,$pictemp);
				array_push($player3,$totalPoints);
				array_push($allHands,$player3);
			}
			
			if($playerNumber == 3)
			{
				array_unshift($player4,$pictemp);
				array_push($player4,$totalPoints);
				array_push($allHands,$player4);
				
				shuffle($allHands);
				
				foreach($allHands as $element => $inner_array)
				{
					foreach($inner_array as $card)
					{
						echo $card;
					}
					echo "</br></br>";
				}
			}
			
			#Jumping out of the while loop.
			$flag = false;
		}
		
	}
	
	#Displaying the total Points.
	//echo "Total Points: " . $totalPoints; echo "<br>";
	
	#myPoints array now holds all the values for each player.
	#so myPlayers[0] will correspond to myPoints[0], same for [1],[2],[3].
	#so we can store all the points here from each player for later using the sessions.
	$myPoints[$playerNumber] = $totalPoints;
	
}
#------------------------------------------------------------------------

function displayElapsedTime(){
	session_start();
	global $starttime;
	global $averagetime;
	global $sessions;
	$endtime = microtime() - $starttime;
	
	$_SESSION['averagetime'] = $_SESSION['averagetime']+$endtime;
	$avg = 0;
	if($_SESSION['sessions'] == 0)
	{
		$avgtime = $endtime;
	}
	else
	{
		$avgtime = $_SESSION['averagetime']/($_SESSION['sessions']+1);
	}

	//print_r($averagetime);
	//echo "</br>";
	//print_r($_SESSION['averagetime']);
	echo "</br>";
	echo "Current session time: " . number_format($endtime, 5) . " seconds </br>" ;
	echo "Average time elapsed: " . number_format($avgtime, 5) . " seconds";
	echo "<h3> Number of Times Played: ".number_format($_SESSION['sessions']) ."</h3>"; 
	/*if($_SESSION['sessions'] >= 3)
	{
		session_destroy();
	}
	else
	{*/
	$_SESSION['sessions'] +=1;
	//}
}





?>