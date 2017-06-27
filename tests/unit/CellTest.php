<?php


class CellTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $env;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateAliveCell()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $this->assertTrue($cell->isAlive());
    }

    public function testCreateDeadCell()
    {
        $cell = \app\spirits\Cell::createDeadCell(0, 0);
        $this->assertFalse($cell->isAlive());
    }

    public function testSetNextGenerationAlive()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cell->setNextGenerationAlive();
        $cell->moveToNextGeneration();
        $this->assertTrue($cell->isAlive());
    }

    public function testSetNextGenerationDead()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cell->setNextGenerationDie();
        $cell->moveToNextGeneration();
        $this->assertFalse($cell->isAlive());
    }

    /**
     * alive cell with 0 alive cell neighbors
     */
    public function testGeneratingAliveCellWith0AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cells = [
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
        ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertFalse($cell->isAlive());
    }

    /**
     * alive cell with 1 alive cell neighbors
     */
    public function testGeneratingAliveCellWith1AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cells = [
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertFalse($cell->isAlive());
    }

    /**
     * alive cell with 2 alive cell neighbors
     */
    public function testGeneratingAliveCellWith2AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cells = [
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
        ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertTrue($cell->isAlive());
    }

    /**
     * alive cell with 4 alive cell neighbors
     */
    public function testGeneratingAliveCellWith4AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createAliveCell(0, 0);
        $cells = [
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
        ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertTrue($cell->isAlive());
    }

    /**
     * dead cell with 2 alive cell neighbors
     */
    public function testGeneratingDeadCellWith2AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createDeadCell(0, 0);
        $cells = [
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
        ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertFalse($cell->isAlive());
    }

    /**
     * dead cell with 2 alive cell neighbors
     */
    public function testGeneratingDeadCellWith3AliveCellNeighbors()
    {
        $cell = \app\spirits\Cell::createDeadCell(0, 0);
        $cells = [
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createAliveCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
            \app\spirits\Cell::createDeadCell(0, 0),
        ];
        $cell->setNeighbors($cells);
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertTrue($cell->isAlive());
        $cell->generating();
        $cell->moveToNextGeneration();
        $this->assertTrue($cell->isAlive());
    }
}