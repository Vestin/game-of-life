<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/26/17
 * Time: 1:54 PM
 */

namespace app\exceptions;


use app\spirits\Environment;

class SysException extends \Exception
{
    public static function CellInitError($x, $y, Environment $env)
    {
        return new static('Cell Init Error:Cell X-axis' . $x . ';Env max X-axis:' . $env->getWidth() . PHP_EOL . 'Cell Y-axis:' . $y . ';Env max Y-axis' . $env->getHeight());
    }

    public static function EnvInitError($x, $y)
    {
        return new static('Environment width(X-axis) or height(Y-axis) cannot less or equal Zero; Your input width:' . $x . '; height:' . $y);
    }

    public static function CellNotFound($x, $y)
    {
        return new static('The Cell you are finding is NOT FOUND.X-axis:' . $x . ';Y-axis:' . $y);
    }
}