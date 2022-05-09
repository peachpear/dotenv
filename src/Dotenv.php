<?php

namespace Dotenv;

/**
 * Class Dotenv
 * @package Dotenv
 */
class Dotenv
{
    /**
     * @var $data
     */
    protected static $data;

    /**
     * @param $file
     */
    public static function load($file)
    {
        if (!is_file($file)) {
            return;
        }

        $env = parse_ini_file($file, true);
        static::set($env);
    }

    /**
     * @param array $env
     */
    protected static function set($env = [])
    {
        foreach ($env as $key => $val) {
            $name = strtoupper($key);

            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    $item = $name . '_' . strtoupper($k);
                    static::$data[$item] = $v;
                }
            } else {
                static::$data[$name] = $val;
            }
        }
    }

    /**
     * 获取环境变量值
     * @access public
     * @param  string $name    环境变量名（支持二级 . 号分割）
     * @param  string $default 默认值
     * @return mixed
     */
    public static function get($name, $default = null)
    {
        $name = strtoupper(str_replace('.', '_', $name));

        if (!isset(static::$data[$name])) {
            return $default;
        }

        $result = static::$data[$name];
        if (false !== $result) {
            if ('false' === $result) {
                $result = false;
            } elseif ('true' === $result) {
                $result = true;
            }
        }

        return $result;
    }
}