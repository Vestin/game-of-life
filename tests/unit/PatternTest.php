<?php


class PatternTest extends \Codeception\Test\Unit
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

    /**
     * @expectedException \app\exceptions\SysException
     */
    public function testPatternGetError()
    {
        \app\Pattern::getByName('unkownPattern');
    }

    public function testPatternGetter()
    {
        $pattern = \app\Pattern::getByName('blinker');
        $this->assertEquals(30,$pattern->getCanvasWidth());
        $this->assertEquals(30,$pattern->getCanvasHeight());
        $this->assertEquals('yellow',$pattern->getAliveCellColor());
        $this->assertEquals('blinker',$pattern->getPatternName());
        $this->assertEquals('black',$pattern->getDeadCellColor());
    }
}