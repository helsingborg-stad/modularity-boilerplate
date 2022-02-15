<?php

class Setup
{
    private static $config;

    public function __construct()
    {
        self::log("Starting setup", 'info');

        if (self::$config = self::getConfig()) {
            self::updateFile(__DIR__ . '/composer.json');

            //Test move
            self::moveFile(
                __DIR__ . '/modularity-recommend.php',
                __DIR__ . '/modularity-boilerplate.php'
            );

            //Remove me
            if (self::remove()) {
                self::log("All done! Now go and make something beautiful!", 'info');
            }
        } else {
            self::log("Exiting setup");
        }
    }

    /**
     * Replace contents of composer json
     *
     * @return void
     */
    private static function updateFile($filename)
    {
        foreach (self::$config as $key => $value) {
            $result = self::makeReplacements(
                "{{BPREPLACE" . strtoupper($key) . "}}",
                $value,
                $filename
            );

            if (!$result) {
                self::err("Failed to replace " . $filename);
                break;
            }
        }

        if ($result) {
            self::log("Successfully updated " . $filename);
        }
    }

    /**
     * Move a file
     *
     * @return bool
     */
    private static function renameFile($from, $to)
    {
        if (rename($from, $to)) {
            self::log("Successfully moved file " . $from . " to " . $to);
            return true;
        }
        self::err("Could not move file " . $from . " to " . $to);
        return false;
    }

    /**
     * Replace contents of file
     *
     * @param string $from
     * @param string $to
     * @param string $filename
     * @return bool
     */
    public static function makeReplacements($from, $to, $filename)
    {

        if (!file_exists($filename)) {
            return false;
        }

        $content = str_replace(
            $from,
            $to,
            file_get_contents($filename)
        );

        if (!file_put_contents($filename, $content)) {
            return false;
        }

        return true;
    }

    /**
     * Get config
     *
     * @return bool | string
     */
    public static function getConfig()
    {
        if (file_exists(self::getConfigPath())) {
            self::log("Found config file in " . self::getConfigPath());
            return (object) json_decode(
                file_get_contents(self::getConfigPath()),
                true
            );
        } else {
            self::log("Could not find config file in " . self::getConfigPath());
        }
        return false;
    }

    /**
     * Get configuration file path
     *
     * @return string
     */
    private static function getConfigPath()
    {
        return self::getBasePath() . 'setup.json';
    }

    /**
     * Get base path
     *
     * @return string
     */
    private static function getBasePath()
    {
        return rtrim(__DIR__, '/') . "/";
    }

    /**
     * Log message to user
     *
     * @param string $message   The message
     * @param string $type    Should not be changed
     */
    public static function log($message, $type = null, $trimPath = true)
    {
        //Trim path in log msg, to make them readable
        if ($trimPath === true) {
            $message = str_replace(__DIR__, '', $message);
        }

        //Set type
        if (is_null($type)) {
            $type = __FUNCTION__;
        }

        //Print
        echo self::getColor($type) . "[" . strtoupper($type) . "] " . $message . "\n";
    }

    /**
     * Get colorcoding for messages
     *
     * @param string $type
     */
    private static function getColor($type)
    {
        if ($type == 'info') {
            return "\033[0;95m";
        }
        if ($type == 'log') {
            return "\033[0;32m";
        }
        if ($type == 'err') {
            return "\033[0;31m";
        }
    }

    /**
     * Invoke log, but with error prefix.
     *
     * @param string $message
     */
    public static function err($message)
    {
        self::log($message, __FUNCTION__);
    }

    /**
     * Remove this setup script
     */
    public static function remove()
    {
        $files = [
            self::getBasePath() . "setup.json",
            self::getBasePath() . "setup.php"
        ];

        if (!empty($files) && is_array($files)) {
            self::log("Cleaing up: " . implode(", ", $files));
            foreach ($files as $file) {
                if (!unlink($file)) {
                    self::err("Failed to remove " . $file);
                }
            }
            return true;
        }
        self::err("Nothing to delete.");
        return false;
    }
}

new Setup();
