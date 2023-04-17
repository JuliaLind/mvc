## Pseudokod  

### Part1

#### Player's turn

Player chooses 'pick card' or 'done'.

IF player picks card THEN
    IF value of player's hand is higher than 21 THEN
        the bank wins. Go to part 2
    ELSE IF more than 0 cards left in card-deck THEN
        it's players turn again
    ELSE
        player is the winner. Go to part 2
    ENDIF
ELSE IF player is done THEN
    it's bank's turn
ENDIF


#### Bank's turn

WHILE value of bank's hand is lesser than 17* and there are more than 0 cards left i deck
    bank draws new card
ENDWHILE

When bank is done:
    IF value of bank's hand is above 21 THEN
        player is the winner.
    ELSE IF value of bank's hand equals 21 or if value of bank's hand equals value of player's hand THEN  
        bank is the winner.
    ELSE IF value of bank's hand is lesser than 21 THEN
        check for largest difference between (21 - bank's hand value) and (21 - player's hand value).
        The one with smaller difference is the winner.
    ENDIF
Go to part 2

*applicable on easy level. On levels medium and hard bank draws until risk of getting 'fat' is above 50% 

### Part 2:

"Transfer" money from game pot to winner.
Save winner's name.

IF either bank or player is out of money or if there are no cards left in deck THEN
    the game is over
ELSE
    continue to next round
ENDIF



