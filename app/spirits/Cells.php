<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 3:37 PM
 */

namespace app\spirits;


use app\exceptions\SysException;

class Cells
{

    /**
     * @var Cell[]
     */
    public $cells;

    /**
     * @var Environment
     */
    public $env;

    /**
     * Cells constructor.
     * @param $x
     * @param $y
     * @param $aliveCells
     * @param Environment $env
     */
    private function __construct($x, $y, $aliveCells, Environment $env)
    {
        $height = $env->getHeight();
        $width = $env->getWidth();
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                //array_search([$x,$y],$aliveCells);
                $alive = false;
                //echo 'x:' . $x . ';y:' . $y . PHP_EOL;
                foreach ($aliveCells as $aliveCell) {
                    if ($x == $aliveCell[0] && $y == $aliveCell[1]) {
                        $this->cells[] = Cell::createAliveCell($x, $y);
                        $alive = true;
                        break;
                    }
                }
                if (!$alive) {
                    $this->cells[] = Cell::createDeadCell($x, $y);
                }
            }
        }

        $this->env = $env;
        $this->setCellsNeighbors();
    }

    private function setCellsNeighbors()
    {

        foreach ($this->cells as $cell) {
            $this->setCellNeighbor($cell);
        }
    }

    public function setCellNeighbor(Cell $cell)
    {
        $envX = $this->env->getWidth();
        $envY = $this->env->getHeight();
        $neighbors = [];
        $x = $cell->getX();
        $y = $cell->getY();
        $startX = ($x - 1) < 0 ? 0 : $x - 1;
        $endX = ($x + 1) > ($envX - 1) ? ($envX - 1) : $x + 1;
        $startY = ($y - 1) < 0 ? 0 : $y - 1;
        $endY = ($y + 1) > ($envY - 1) ? ($envY - 1) : $y + 1;
        for ($i = $startX; $i <= $endX; $i++) {
            for ($j = $startY; $j <= $endY; $j++) {
                if ($x == $i && $y == $j) {
                    continue;
                }
                $neighbors[] = $this->getByXY($i, $j);
            }
        }
        $cell->setNeighbors($neighbors);
    }

    /**
     * @param $x
     * @param $y
     * @param $aliveCells
     * @param $env
     * @return static
     */
    public static function init($aliveCells, Environment $env)
    {
        $x = $env->getWidth();
        $y = $env->getHeight();
        return new static($x, $y, $aliveCells, $env);
    }

    /**
     * @return int
     */
    public function countCells()
    {
        return count($this->cells);
    }


    /**
     * @param Cell[] $cells
     * @param $x
     * @param $y
     */
    public function getByXY($x, $y)
    {
        foreach ($this->cells as $cell) {
            if ($cell->getX() == $x && $cell->getY() == $y) {
                return $cell;
            }
        }

        throw SysException::CellNotFound($x, $y);
    }

    /**
     * generating
     */
    public function generating()
    {
        foreach($this->cells as $cell){
            $cell->generating();
        }

        foreach($this->cells as $cell){
            $cell->moveToNextGeneration();
        }
    }

}