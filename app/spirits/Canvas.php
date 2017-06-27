<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 3:34 PM
 */

namespace app\spirits;


class Canvas
{

    /**
     * cell color
     * @var array
     */
    private $avaColor = [
        'black',
        'red',
        'green',
        'yellow',
        'blue',
        'magenta',
        'cyan',
        'white'
    ];

    public $drawer;

    /**
     * @var Cell[];
     */
    public $cells;

    public $env;

    /**
     * generation times
     * @var
     */
    private $generation;

    /**
     * @var string
     */
    private $deadCellColor = 'yellow';

    /**
     * @var string
     */
    private $aliveCellColor = 'green';

    /**
     * Canvas constructor.
     * @param $drawer
     * @param Cells $cells
     */
    public function __construct($drawer, Cells $cells, Environment $env)
    {
        $this->drawer = $drawer;
        $this->cells = $cells;
        $this->env = $env;
    }

    /**
     * @param $color
     */
    public function setDeadCellColor($color)
    {
        if (!in_array($color, $this->avaColor)) {
            $color = 'yellow';
        }
        $this->deadCellColor = $color;
    }

    /**
     * @param $color
     */
    public function setAliveCellColor($color)
    {
        if (!in_array($color, $this->avaColor)) {
            $color = 'yellow';
        }
        $this->aliveCellColor = $color;
    }

    /**
     * draw
     */
    public function draw()
    {
        $str = '';
        for ($y = 0; $y < $this->env->getHeight(); $y++) {
            $line = $y + 1;
            $str .= "\33[{$line};0H\033[K";
            for ($x = 0; $x < $this->env->getWidth(); $x++) {
                $cell = $this->cells->getByXY($x, $y);
                if ($cell->isAlive()) {
                    $str .= '<bg=' . $this->aliveCellColor . '>  </>';
                } else {
                    $str .= '<bg=' . $this->deadCellColor . '>  </>';
                }
            }
        }
        $str .= 'generation:' . ++$this->generation;
        $str .= "\33[u";
        $this->drawer->write($str);
    }
}