Class User (DB-table):
id (autogenerated)
username
password (password hash)
coins (coins to bet, possible to use coins to switch cards? pick new card?)
if win against bot points turned to money


Class Score (DB-table):
userid
username?
score


Class cardGraphicGenerator:
takes a rank and suit as input and returns img link and alt text

Class card:
has a rank and a suit

Deck Of Cards: 
attr array of cardobjects
methods:
dealOne();


Shop
endless supply of own money
collect: take money to purchase stuff
sell: fill upp players money


cardhand
