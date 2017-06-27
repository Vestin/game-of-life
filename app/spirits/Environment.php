<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 1:47 PM
 */

namespace app\spirits;

use app\exceptions\SysException;

/**
 * Class Environment
 * @package app\spirits
 */
class Environment
{
    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * Environment constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        if ($width <= 0 || $height <= 0) {
            throw SysException::EnvInitError($width,$height);
        }
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


}