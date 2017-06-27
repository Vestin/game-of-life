<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/27/17
 * Time: 2:34 PM
 */

namespace app;

use app\exceptions\SysException;

/**
 * Class PopularPattern
 * @package app
 */
class Pattern
{
    /**
     * @var int
     */
    public $canvasWidth = 30;

    /**
     * @var int
     */
    public $canvasHeight = 30;

    /**
     * @var array
     */
    public $aliveCells = [];

    /**
     * @var string
     */
    public $aliveCellColor = 'yellow';

    /**
     * @var string
     */
    public $deadCellColor = 'black';

    /**
     * @var string
     */
    public $patternName = '';

    /**
     * Pattern constructor.
     * @param $patternName
     * @param $patternArray
     * @throws SysException
     */
    private function __construct($patternName, $patternArray)
    {
        $this->patternName = $patternName;
        if (array_key_exists('aliveCellColor', $patternArray)) {
            $this->aliveCellColor = $patternArray['aliveCellColor'];
        }
        if (array_key_exists('deadCellColor', $patternArray)) {
            $this->deadCellColor = $patternArray['deadCellColor'];
        }
        if (array_key_exists('canvasWidth', $patternArray)) {
            $this->canvasWidth = (int)$patternArray['canvasWidth'];
        }
        if (array_key_exists('canvasHeight', $patternArray)) {
            $this->canvasHeight = (int)$patternArray['canvasHeight'];
        }

        if (!array_key_exists('aliveCells', $patternArray)) {
            throw new SysException('Pattern must set alive cells');
        }

        $this->aliveCells = $patternArray['aliveCells'];
    }

    /**
     * @param $name
     * @return Pattern
     * @throws SysException
     */
    static public function getByName($name)
    {
        $fileName = __DIR__ . '/../patterns/' . $name . '.json';
        if (file_exists($fileName)) {
            $patternArray = json_decode(file_get_contents($fileName), true);
            if (!is_array($patternArray)) {
                throw new SysException('pattern json file parse failed');
            }
            return new self($name, $patternArray);
        }
        throw new SysException('pattern not found : ' . $fileName);
    }

    /**
     * @param $patternName
     * @param array $aliveCells
     * @param int|null $canvasWidth
     * @param int|null $canvasHeight
     * @param string|null $aliveCellColor
     * @param string|null $deadCellColor
     * @return static
     */
    static public function formUserDefine(
        $patternName,
        array $aliveCells,
        int $canvasWidth = null,
        int $canvasHeight = null,
        string $aliveCellColor = null,
        string $deadCellColor = null
    ) {
        $patternArray = [
            'aliveCells' => $aliveCells,
            'canvasWidth' => $canvasWidth,
            'canvasHeight' => $canvasHeight,
            'aliveCellColor' => $aliveCellColor,
            'deadCellColor' => $deadCellColor
        ];
        foreach ($patternArray as $key => $pattern) {
            if (empty($pattern)) {
                unset($patternArray[$key]);
            }
        }
        return new static($patternName, $patternArray);
    }

    /**
     * @return string
     */
    public function getPatternName()
    {
        return $this->patternName;
    }

    /**
     * @return int
     */
    public function getCanvasWidth()
    {
        return $this->canvasWidth;
    }

    /**
     * @return int
     */
    public function getCanvasHeight()
    {
        return $this->canvasHeight;
    }

    /**
     * @return array
     */
    public function getAliveCells()
    {
        return $this->aliveCells;
    }

    /**
     * @return string
     */
    public function getAliveCellColor()
    {
        return $this->aliveCellColor;
    }

    /**
     * @return string
     */
    public function getDeadCellColor()
    {
        return $this->deadCellColor;
    }
}