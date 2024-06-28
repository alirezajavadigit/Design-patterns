<?php

/*
|--------------------------------------------------------------------------
| Singleton Design Pattern
|--------------------------------------------------------------------------
| Implement Singleton Design Pattern to ensure a class has only one instance 
| and provide a global point of access to it.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational
| @version   1.0.0
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/Design-patterns
|--------------------------------------------------------------------------
*/

namespace Creational\Singleton;

class Singleton
{
    /**
     * The singleton instance of the class.
     *
     * @var self|null The singleton instance of the class.
     */
    private static $instance = null;

    /**
     * Lock for thread safety.
     * 
     * @var mixed Lock for thread safety.
     */
    private static $lock = null;

    /**
     * Constructor method is private to prevent direct instantiation of the class.
     * 
     * This constructor method is made private to prevent external instantiation 
     * of the class. It ensures that the class can only be instantiated from 
     * within itself, which is essential for implementing the Singleton pattern.
     */
    private function __construct()
    {
        // Initialize lock
        if (is_null(self::$lock)) {
            self::$lock = new \stdClass();
        }
    }

    /**
     * Prevent instance from being cloned.
     */
    private function __clone()
    {
    }

    /**
     * Prevent instance from being unserialized.
     */
    private function __wakeup()
    {
    }

    /**
     * Get the singleton instance of the class.
     *
     * @return self The singleton instance of the class.
     * 
     * This method returns the singleton instance of the class. If the instance 
     * does not exist, it creates a new one and assigns it to the static 
     * property $instance. This ensures that only one instance of the class is 
     * created throughout the application's lifecycle.
     */
    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            // Thread-safe lazy initialization
            $lock = self::$lock; // to ensure thread safety
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
        }

        return self::$instance;
    }
}
