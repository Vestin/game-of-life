<?php


class DirectorTest extends \Codeception\Test\Unit
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

    // tests
    public function testGenerating()
    {
        $pattern = \app\Pattern::formUserDefine('my',[[1, 1], [2, 2], [3, 3]],10,10);
        $director = \app\spirits\Director::setUpScreen($pattern,new stdClass());
        $cells = $director->cells;
        $director->generating();
        $this->assertFalse($cells->getByXY(1,2)->isAlive());
        $this->assertFalse($cells->getByXY(1,1)->isAlive());
        $this->assertTrue($cells->getByXY(2,2)->isAlive());
        $this->assertFalse($cells->getByXY(3,3)->isAlive());
        $director->generating();
        $director->generating();
        $this->assertFalse($cells->getByXY(1,2)->isAlive());
        $this->assertFalse($cells->getByXY(1,1)->isAlive());
        $this->assertFalse($cells->getByXY(3,3)->isAlive());
        $this->assertFalse($cells->getByXY(1,1)->isAlive());
        $this->assertFalse($cells->getByXY(1,2)->isAlive());
        $this->assertFalse($cells->getByXY(1,3)->isAlive());
        $this->assertFalse($cells->getByXY(2,1)->isAlive());
        $this->assertFalse($cells->getByXY(2,3)->isAlive());
        $this->assertFalse($cells->getByXY(3,1)->isAlive());
        $this->assertFalse($cells->getByXY(3,2)->isAlive());
        $this->assertFalse($cells->getByXY(3,3)->isAlive());
        foreach($cells->getByXY(2,2)->getNeighbors() as $cell){
            $this->assertFalse($cell->isAlive());
        }
        $this->assertEquals(8,count($cells->getByXY(2,2)->getNeighbors()));
        $this->assertFalse($cells->getByXY(2,2)->isAlive());
    }
}