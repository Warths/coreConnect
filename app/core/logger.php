<?php

namespace App\Core;

use App\Core\Misc\Styles;

class Logger {

    static private $level = 0;
    static private $format = "[%time%] - %message%";
    static private $logDir = __DIR__."/../../log/";
    static private $tmpDir = __DIR__."/../../tmp/";
    static private $fileName = "%date%.log";

    static public $colors = [
        "DISCRETE" => Styles::NORMAL.Styles::DARK_GRAY,
        "DEBUG"    => Styles::NORMAL.Styles::LIGHT_YELLOW,
        "INFO"     => Styles::NORMAL.Styles::LIGHT_BLUE,
        "WARNING"  => Styles::NORMAL.Styles::LIGHT_RED,
        "ERROR"    => Styles::ITALIC.Styles::BOLD.Styles::RED
    ];

    static public $logLevels = [
        "DISCRETE" => 0,
        "DEBUG"    => 1,
        "INFO"     => 2,
        "WARNING"  => 3,
        "ERROR"    => 4
    ];

    public $name;

    function __construct($name) {
        $this->name = $name;
    }

    static public function configure($level=null,$format=null,$logDir=null,$fileName=null) {
        if ($level != null) {
            self::setLevel($level);
        }
        if ($format != null) {
            self::setLevel($format);
        }
        if ($logDir != null) {
            self::setLevel($logDir);
        }
        if ($fileName != null) {
            self::setfileName($fileName);
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

    static public function getfileName() {
        return self::$fileName;
    }

    static public function setfileName($fileName) {
        self::$fileName = $fileName;
    }
    

    static public function dump_configuration() {
        return [
            "level"=>self::$level,
            "format"=>self::$format,
            "logDir"=>self::$logDir,
            "fileName"=>self::$fileName
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
        return self::$logDir.self::$fileName;
    }

    static private function tmpLogPath() {
        return self::$tmpDir."latest.log";
    }


    static private function formatDate() {
        $time = microtime(true);
        return date("d/m/Y - h:i:s", $time) . "." . $time * 100 % 100; 
    }


    private function log($message, $mode="INFO") {
        if (self::$logLevels[$mode] >= self::$level) {
            $color = self::$colors[$mode];
            $message = $this->formatMessage($message, $mode);
            self::log_to_file(self::logPath(), $message);
            self::log_to_file(self::tmpLogPath(), $color.$message.Styles::NORMAL);    
        }
    }

    private function formatMessage($message, $mode) {
        $message = str_replace('%message%', $message, self::$format);
        $message = str_replace('%date%', "Current_Date", $message);
        $message = str_replace("%mode%", $mode, $message);
        $message = str_replace("%name%", $this->name, $message);
        $message = str_replace("%time%", self::formatDate(), $message);
        return $message;
    }

    public function discrete($message) {
        $this->log($message, "DISCRETE");
    }

    public function debug($message) {
        $this->log($message, "DEBUG");
    }

    public function info($message) {
        $this->log($message, "INFO");
    }

    public function warning($message) {
        $this->log($message, "WARNING");
    }

    public function error($message) {
        $this->log($message, "ERROR");
    }



}