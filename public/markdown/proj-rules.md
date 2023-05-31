class for counting possible cards in deck & get statistics of remaining count of each card and remaining count of each suit & percentage of all

Co not recaulculate stats each time, have two associative arrays:
one for count per value and one for each suit

Each rules is a class
Rule has: 
1. name
2. value
3. getter for name/value
4. a method for determining if the rule is fullfilled (returns bool)
5. a method that given a card can give a true or false if it's benefits the player to add card to the given hand

Put all rules in array randing from max value to min value
Loop thorugh the rule-array for each hand, if rule is true the break loop, continue with next hand
During game: (use case switch card count) loop through highest to lowest for suggestion, if no rule is possible suggest a random placement card (or tell player game is pointless?) To suggest make background of placement blinking or highlight border? see nr 2.

When all hands are full (nr of cards in each hand == 5): point count. See nr 1.

American point system

name: Royal flush
points: 100

name: Straight flush
points: 75

name: Four of a kind
points: 50
1. if max count of unique values == 4 then True
2. if card count < 5 && (count unique values == 1 && count unique values == 2 & max count unique value = (card count - 1))
also check if after adding vard card count < 5 there are enough cards of same count in deck to get to four

name: Full house
points: 25
1. if count unique values = 2 and max count of same value == 3 then True
2. if unique count == 1 && card count <= 3 or
if unique count == 2 && card count <= 4 && given card == one of the two values
also check if after adding card if card count < 5 if there are enough cards of same count in deck to get to three

name: Flush
points: 20
1. if count cards of unique suit == 1 then True
2. If card count < 5  && cards of unique suit == 1 and suit of the given card == suit of the cards in hand then True.
Also check if there are enough cards left in deck of same suit to get to flush

name: Straight
points: 15
1. if count unique values = 5 & max-value - min-value = 4 then true
2. if card count < 5 && count unique values == card count & max value - min-value <= 4 the True.
Also check if there are enough cards left in deck to get to 

name: Three of a kind
points: 10
1. if maxcount of a unique value is >= 3 then True
2. if maxcount of a unique value < 3 
examples:
[1] possible with any card
[1, 2] possible with 1s, 2s or any other
[1, 1] possible with 1s or any other
[1, 1, 2] possible with 1s or 2s
[1, 1, 2, 3] possible with 1s
[1, 2, 3, 4] not possible

name: Two pairs
points: 5
1. if count unique values <= (card count - 2) then True
2. if card count < 4 & card value == value of any of the other cards in hand or 
if card count < 4 && count unique values <= card count - 1 && card value = value of any of other cards in hand then True
[1] possible with any card
[1, 2] possible with any one 1 and/or one 2 or two of any card
[1, 1] possible with two of any cards

name: One pair
points: 2
1. if count unique values < card count then True
2. if card count < 5 & card value == any of the other card values then True

