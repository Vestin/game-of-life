Game of Life
---
@Vestin

Full name *Conway's Game of Life*
> Conway's Game of Life, also known as the Game of Life or simply Life, is a cellular automaton devised by the British mathematician John Horton Conway in 1970. It is the best-known example of a cellular automaton.
  The "game" is actually a zero-player game, meaning that its evolution is determined by its initial state, needing no input from human players. One interacts with the Game of Life by creating an initial configuration and observing how it evolves.
  
Rules
--- 
The universe of the Game of Life is an infinite two-dimensional orthogonal grid of square cells, each of which is in one of two possible states, live or dead. Every cell interacts with its eight neighbours, which are the cells that are directly horizontally, vertically, or diagonally adjacent. At each step in time, the following transitions occur:
* Any live cell with fewer than two live neighbours dies (referred to as underpopulation or exposure[1]).
* Any live cell with more than three live neighbours dies (referred to as overpopulation or overcrowding).
* Any live cell with two or three live neighbours lives, unchanged, to the next generation.
* Any dead cell with exactly three live neighbours will come to life.
  The initial pattern constitutes the 'seed' of the system. The first generation is created by applying the above rules simultaneously to every cell in the seed — births and deaths happen simultaneously, and the discrete moment at which this happens is sometimes called a tick. (In other words, each generation is a pure function of the one before.) The rules continue to be applied repeatedly to create further generations.

See more at [here](http://www.conwaylife.com/w/index.php?title=Conway%27s_Game_of_Life)

Install
---
require
* php>7
* composer

```
git clone git@github.com:Vestin/game-of-life.git
cd game-of-life
composer install
```

Usage
--

basic
```
./gameOfLife.php start --pattern=Glider
```

patterns:
* blinker
* line
* Glider
* Pulsar
* R-Pentomino

define your pattern:
make new json file in *patterns* folder,like `MyPattern.json`
```
{
  "aliveCells": [
    [x,y],[x,y] //alive cell points
  ],
  "aliveCellColor": "yellow",
  "deadCellColor": "black",
  "canvasWidth": 30,
  "canvasHeight": 30
}
```
use `./gameOfLife.php start --pattern=MyPattern`

Options & Help
--
```
Usage:
  start [options]

Options:
  -p, --pattern=PATTERN                  the pattern you defined, input file name of your pattern, patterns are json files under patterns folder; such as -p bliner [default: "line"]
      --deadcellcolor[=DEADCELLCOLOR]    set dead cell color, avaliable option: black, red, green, yellow, blue, magenta, cyan and white [default: ""]
      --alivecellcolor[=ALIVECELLCOLOR]  set alive cell color, avaliable option: black, red, green, yellow, blue, magenta, cyan and white [default: ""]
      --speed[=SPEED]                    set generating speed, type int, 1000 equal 1 sec [default: 1000]
  -h, --help                             Display this help message
  -q, --quiet                            Do not output any message
  -V, --version                          Display this application version
      --ansi                             Force ANSI output
      --no-ansi                          Disable ANSI output
  -n, --no-interaction                   Do not ask any interactive question
  -v|vv|vvv, --verbose                   Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  Game of life
  @Vestin https://github.com/Vestin
  see detail in https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life
```

Further Development
--
use the codecept test framework

Test:
```
./vendor/bin/codecept run unit
```

