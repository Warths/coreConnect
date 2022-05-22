<?php

namespace App\Core;

use App\Core\Misc\Colors;

class Logger {


    static private $level = 0;
    static private $format = "[%time%] %name% %message%";
    static private $logDir = __DIR__."/../../log/";
    static private $tmpDir = __DIR__."/../../tmp/";
    static private $filename = "%date%.log";
    public $name;

    function __construct($name) {
        $this->name = $name;
    }

    static public function configure($level=null,$format=null,$logDir=null,$filename=null) {
        if ($level != null) {
            self::setLevel($level);
        }
        if ($format != null) {
            self::setLevel($format);
        }
        if ($logDir != null) {
            self::setLevel($logDir);
        }
        if ($logDir != null) {
            self::setLevel($logDir);
        }

    }

    static public function getLevel() {
        return self::$level;
    }

    static public function setLevel($level) {
        self::$level = $level;
    }
    
    static public function getFormat() {
        return self::$format;
    }

    static public function setFormat($format) {
        self::$format = $format;
    }

    static public function getlogDir() {
        return self::$logDir;
    }

    static public function setlogDir($logDir) {
        self::$logDir = realpath($logDir);
    }

    static public function getFileName() {
        return self::$filename;
    }

    static public function set($filename) {
        self::$filename = $filename;
    }
    

    static public function dump_configuration() {
        return [
            "level"=>self::$level,
            "format"=>self::$format,
            "logDir"=>self::$logDir,
            "filename"=>self::$filename
        ];
    }

    static public function log_to_file($path, $message) {
        self::check_dir(dirname($path));
        file_put_contents($path, $message."\n", FILE_APPEND);
    }

    static private function check_dir($name) {
        if (!file_exists($name)) {
            mkdir($name);
        }
    }

    static private function logPath() {
        return self::$logDir.self::$filename;
    }

    static private function tmpLogPath() {
        return self::$tmpDir."latest.log";
    }

    public function info($message) {
        self::log_to_file(self::logPath(), "[".$this->name."] ".$message);
        self::log_to_file(self::tmpLogPath(), Colors::RED." [".$this->name."] ".$message." ".Colors::NORMAL);
    }

}