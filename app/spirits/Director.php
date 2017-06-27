<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 2:31 PM
 */

namespace app\spirits;


use app\Pattern;

class Director
{
    /**
     * @var Cells
     */
    public $cells;

    /**
     * @var Environment
     */
    public $env;

    /**
     * @var Canvas
     */
    public $canvas;

    /**
     * @var Pattern
     */
    public $pattern;

    /**
     * Director constructor.
     * @param Pattern $pattern
     * @param $drawer
     */
    private function __construct(Pattern $pattern, $drawer)
    {
        $this->pattern = $pattern;
        $this->env = new Environment($this->pattern->getCanvasWidth(), $this->pattern->getCanvasHeight());
        $this->cells = Cells::init($this->pattern->getAliveCells(), $this->env);
        $this->canvas = new Canvas($drawer, $this->cells, $this->env);
        $this->setCanvasColor($this->pattern->getDeadCellColor(), $this->pattern->getAliveCellColor());
    }

    /**
     * @param Pattern $pattern
     * @param $drawer
     * @return static
     */
    public static function setUpScreen(Pattern $pattern, $drawer)
    {
        return new static($pattern, $drawer);
    }

    /**
     * generating
     */
    public function generating()
    {
        //predict next generation
        $this->cells->generating();
    }

    /**
     * show the screen set
     */
    public function draw()
    {
        $this->canvas->draw();
    }

    /**
     * @param $deadCellColor
     * @param $aliveCellColor
     */
    public function setCanvasColor($deadCellColor, $aliveCellColor)
    {
        if(!empty($deadCellColor)){
            $this->canvas->setDeadCellColor($deadCellColor);
        }
        if(!empty($aliveCellColor)){
            $this->canvas->setAliveCellColor($aliveCellColor);
        }
    }
}