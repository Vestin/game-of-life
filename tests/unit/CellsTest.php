<?php


class CellsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateCellsOne()
    {
        $cells = \app\spirits\Cells::init([[0, 0]], new \app\spirits\Environment(10, 10));
        $this->assertEquals(100, $cells->countCells());
    }

    public function testCreateCellsTwo()
    {
        $cells = \app\spirits\Cells::init([[3, 3], [3, 4], [4, 3]], new \app\spirits\Environment(5, 5));
        $this->assertEquals(25, $cells->countCells());
    }

    public function testGetCell()
    {
        $cells = \app\spirits\Cells::init([[3, 3], [3, 4], [4, 3]], new \app\spirits\Environment(5, 5));
        $this->assertTrue($cells->getByXY(3,3)->isAlive());
        $this->assertEquals(3,$cells->getByXY(3,3)->getX());
        $this->assertEquals(3,$cells->getByXY(3,3)->getY());
        $this->assertTrue($cells->getByXY(3,4)->isAlive());
        $this->assertEquals(4,$cells->getByXY(3,4)->getY());
        $this->assertTrue($cells->getByXY(4,3)->isAlive());
        $this->assertFalse($cells->getByXY(1,1)->isAlive());
    }

    public function testSetCellNeighbor(){
        $cells = \app\spirits\Cells::init([[3, 3], [3, 4], [4, 3]], new \app\spirits\Environment(10, 10));
        $cells->setCellNeighbor($cells->getByXY(0,0));
        $this->assertEquals(3,count($cells->getByXY(0,0)->getNeighbors()));
    }

    public function testCellNeighbors(){
        $cells = \app\spirits\Cells::init([[3, 3], [3, 4], [4, 3]], new \app\spirits\Environment(10, 10));
        $this->assertEquals(3,count($cells->getByXY(0,0)->getNeighbors()));
        $this->assertEquals(3,count($cells->getByXY(9,9)->getNeighbors()));
        $this->assertEquals(5,count($cells->getByXY(0,5)->getNeighbors()));
        $this->assertEquals(5,count($cells->getByXY(0,1)->getNeighbors()));
        $this->assertEquals(5,count($cells->getByXY(1,0)->getNeighbors()));
        $this->assertEquals(5,count($cells->getByXY(5,0)->getNeighbors()));
        $this->assertEquals(8,count($cells->getByXY(3,3)->getNeighbors()));
    }
}