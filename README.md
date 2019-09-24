# DOMINOES #
This is a non-interactive linear game of Dominoes. Results are output to standard out.
### Rules
* 28 unique tiles are generated and shuffled.
* Each player draws seven tiles.
* Pick a random tile to start the line of play.
* The players alternately extend the line of play with one tile at one of its two ends.
* A tile may only be placed next to another tile, if their respective values on the connecting ends are identical.
* If a player is unable to place a valid tile, they must keep on pulling tiles from the boneyard until they can.
* The game ends when one player wins by playing their last tile.
* The game end without a winner if the boneyard is empty.

### Set Up and Play
* Clone this repo and change directory in `dominoes/` folder
  ```
  git clone https://github.com/peterojo/dominoes.git
  ```
* Run the `play` command
  ```
  php play
  ```
* Enjoy!

### Requirements
* PHP CLI (~7.0.0)

### Example output
    ```
    ➜ php play
    Initializing game...
    Welcome player Donald Trump!
    Welcome player Xi Jinping!
    The board is: [3:4]
    It is Donald Trump's turn
    Donald Trump has: [3:5][6:6][0:0][3:6][2:2][0:6][4:4]
    Donald Trump plays [5:3] on the left side
    The board is: [5:3][3:4]
    It is Xi Jinping's turn
    Xi Jinping has: [0:3][0:1][2:4][1:3][4:6][0:4][0:2]
    Xi Jinping plays [4:2] on the right side
    The board is: [5:3][3:4][4:2]
    It is Donald Trump's turn
    Donald Trump has: [6:6][0:0][3:6][2:2][0:6][4:4]
    Donald Trump plays [2:2] on the right side
    The board is: [5:3][3:4][4:2][2:2]
    It is Xi Jinping's turn
    Xi Jinping has: [0:3][0:1][1:3][4:6][0:4][0:2]
    Xi Jinping plays [2:0] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0]
    It is Donald Trump's turn
    Donald Trump has: [6:6][0:0][3:6][0:6][4:4]
    Donald Trump plays [0:0] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0]
    It is Xi Jinping's turn
    Xi Jinping has: [0:3][0:1][1:3][4:6][0:4]
    Xi Jinping plays [0:3] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3]
    It is Donald Trump's turn
    Donald Trump has: [6:6][3:6][0:6][4:4]
    Donald Trump plays [3:6] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6]
    It is Xi Jinping's turn
    Xi Jinping has: [0:1][1:3][4:6][0:4]
    Xi Jinping plays [6:4] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4]
    It is Donald Trump's turn
    Donald Trump has: [6:6][0:6][4:4]
    Donald Trump plays [4:4] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4][4:4]
    It is Xi Jinping's turn
    Xi Jinping has: [0:1][1:3][0:4]
    Xi Jinping plays [4:0] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4][4:4][4:0]
    It is Donald Trump's turn
    Donald Trump has: [6:6][0:6]
    Donald Trump plays [0:6] on the right side
    The board is: [5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4][4:4][4:0][0:6]
    It is Xi Jinping's turn
    Xi Jinping has: [0:1][1:3]
    Xi Jinping has to reach for the boneyard.
    Xi Jinping now has: [0:1][1:3][1:2]
    Xi Jinping has to reach for the boneyard.
    Xi Jinping now has: [0:1][1:3][1:2][4:5]
    Xi Jinping plays [4:5] on the left side
    The board is: [4:5][5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4][4:4][4:0][0:6]
    It is Donald Trump's turn
    Donald Trump has: [6:6]
    Donald Trump plays [6:6] on the right side
    The board is: [4:5][5:3][3:4][4:2][2:2][2:0][0:0][0:3][3:6][6:4][4:4][4:0][0:6][6:6]
    DOMINO!!! Donald Trump wins!
    ```