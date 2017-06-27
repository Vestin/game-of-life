<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 1:42 PM
 */

namespace app\spirits;

use app\exceptions\SysException;

/**
 *
 * Class Cell
 * @package app\spirits
 */
class Cell
{

    /**
     * alive status
     */
    CONST CELL_ALIVE = true;

    /**
     * die status
     */
    CONST CELL_DIE = false;


    /**
     * @var int X-axis
     */
    private $x;

    /**
     * @var int Y-axis
     */
    private $y;

    /**
     * @var
     */
    private $aliveStatus;

    /**
     * @var
     */
    private $nextGenerationAliveStatus;


    /**
     * @var Cell[];
     */
    private $neighbors;

    /**
     * Cell constructor.
     * @param int $x
     * @param int $y
     * @param bool $aliveStatus
     * @param Environment $env
     */
    private function __construct($x, $y, $aliveStatus)
    {
        $this->x = $x;
        $this->y = $y;
        $this->aliveStatus = $aliveStatus;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * init an alive cell
     * @param $x
     * @param $y
     * @param Environment $evn
     * @return static
     */
    public static function createAliveCell($x, $y)
    {
        return new static($x, $y, static::CELL_ALIVE);
    }

    /**
     * init a dead cell
     * @param $x
     * @param $y
     * @param Environment $evn
     */
    public static function createDeadCell($x, $y)
    {
        return new static($x, $y, static::CELL_DIE);
    }

    /**
     * @return bool  cell alive status
     */
    public function isAlive()
    {
        return $this->aliveStatus;
    }

    /**
     * set next generation cell status alive
     */
    public function setNextGenerationAlive()
    {
        $this->nextGenerationAliveStatus = static::CELL_ALIVE;
    }

    /**
     * set next generation cell status dead
     */
    public function setNextGenerationDie()
    {
        $this->nextGenerationAliveStatus = static::CELL_DIE;
    }

    /**
     * move to next generation
     */
    public function moveToNextGeneration()
    {
        $this->aliveStatus = $this->nextGenerationAliveStatus;
    }

    /**
     * generating
     */
    public function generating()
    {
        $alive = 0;
        foreach ($this->getNeighbors() as $neighbor) {
            if ($neighbor->isAlive()) {
                $alive++;
            }
        }
        if ($this->isAlive()) {
            $this->aliveCellGeneratingRule($alive);
        } else {
            $this->deadCellGeneratingRule($alive);
        }
    }

    /**
     * alive cell generating rules
     * @param $alive
     */
    private function aliveCellGeneratingRule($alive)
    {
        if ($alive < 2 || $alive > 3) {
            //Any live cell with fewer than two live neighbours dies, as if caused by underpopulation
            //Any live cell with more than three live neighbours dies, as if by overcrowding
            $this->setNextGenerationDie();
        } elseif ($alive == 2 || $alive == 3) {
            //Any live cell with two or three live neighbours lives on to the next generation.
            $this->setNextGenerationAlive();
        }

    }

    /**
     * dead cell generating rules
     * @param $alive
     */
    private function deadCellGeneratingRule($alive)
    {
        //Any dead cell with exactly three live neighbours becomes a live cell.
        if ($alive == 3) {
            $this->setNextGenerationAlive();
        } else {
            $this->setNextGenerationDie();
        }
    }

    /**
     * set neighbors
     * @param array $cells
     */
    public function setNeighbors(array $cells)
    {
        $this->neighbors = $cells;
    }

    /**
     * get neighbors
     * @return Cell[]
     */
    public function getNeighbors()
    {
        return $this->neighbors;
    }

}