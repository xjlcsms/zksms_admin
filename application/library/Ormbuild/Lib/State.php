<?php

namespace Ormbuild\Lib;

final class State {
    
    const NOTIC = 36;
    const WARNING = 33;
    const ERROR = 31;
    
    /**
     * @param string $message
     * @param int $newline
     */
    public static function notice($message, $newline = true) {
        $notice = self::output($message, self::NOTIC);
        echo ($newline === true ? $notice : trim($notice));
    }

    /**
     * @param string $message
     * @param int $level
     */
    public static function warning($message) {
        echo self::output($message, self::WARNING);
    }

    /**
     * @param string $message
     * @param int $level
     */
    public static function error($message) {
        throw new \Ormbuild\Lib\Exception(self::output($message, self::ERROR));
    }
    
    /**
     * 输出信息
     * 
     * @param string $message
     * @return string
     */
    public static function output($message, $type = self::NOTIC) {
        $typeArr = array(
            33 => 'Warning',
            32 => 'Error'
        );
        
        $setting = (int)$type . 'm' . ((isset($typeArr[$type])) ? '[' . $typeArr[$type] . '] ' : ' ');
        
        switch (strtolower(PHP_OS)) {
            case 'linux':
                $message = shell_exec('echo -e "<p>' . $setting . htmlentities($message) . '</p>"');
            break;
            case 'darwin':
                $message = shell_exec('echo "<p>' . $setting . htmlentities($message) . '</p>"');
            break;
            default:
            break;
        }
        
        return $message;
    }
}