## Pseudokod  

### Part1

#### Player's turn

Player chooses 'pick card' or 'done'.

If player picks card:
    if value of player's hand is higher than 21
        then the bank wins. Go to part 2
    else if more than 0 cards left in card-deck
        then it's players turn again
    otherwise player is the winner. Go to part 2

If player done:
    bank's turn


#### Bank's turn

while value of bank's hand is lesser than 17* and there are more than 0 cards left i deck
    bank draws new card.

When bank is done:
    If value of bank's hand is above 21
        then player is the winner.
    Else if value of bank's hand equals 21 or if value of bank's hand equals value of player's hand  
        then bank is the winner.
    Else if value of bank's hand is lesser than 21
        check for largest difference between (21 - bank's hand value) and (21 - player's hand value).
        The one with smaller difference is the winner.
Go to part 2

* applicable on easy level. On levels medium and hard bank draws until risk of getting 'fat' is above 50% 

### Part 2:

"Transfer" money from game pot to winner.
Save winner's name.

If either bank or player is out of money or if there are no cards left in deck
    then the game is over
otherwise continue to next round



