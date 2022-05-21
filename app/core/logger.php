<?php

namespace App\Core;

class Logger {


    static private $level = 0;
    static private $format = "[%time%] %name% %message%";
    static private $dirname = __DIR__."/../../log/";
    static private $filename = "%date%.log";
    public $name;

    function __construct($name) {
        $this->name = $name;
    }

    static public function configure($level=null,$format=null,$dirname=null,$filename=null) {
        if ($level != null) {
            self::setLevel($level);
        }
        if ($format != null) {
            self::setLevel($format);
        }
        if ($dirname != null) {
            self::setLevel($dirname);
        }
        if ($dirname != null) {
            self::setLevel($dirname);
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

    static public function getDirName() {
        return self::$dirname;
    }

    static public function setDirName($dirname) {
        self::$dirname = realpath($dirname);
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
            "dirname"=>self::$dirname,
            "filename"=>self::$filename
        ];
    }

    public function log($message) {
        self::check_dir();
        file_put_contents(self::$dirname.self::$filename, $message."\n", FILE_APPEND);
    }

    static private function check_dir() {
        if (!file_exists(self::$dirname)) {
            mkdir(self::$dirname);
        }
    }

}