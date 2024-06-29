<?php

/*
|--------------------------------------------------------------------------
| Factory Method Design Pattern
|--------------------------------------------------------------------------
| Implement Factory Method Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational
| @author    Alireza Javadi
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/alirezajavadigit/Design-patterns
|--------------------------------------------------------------------------
*/

namespace Creational\FactoryMethod;

/**
 * Interface FactoryMethod
 *
 * This interface declares a method that all concrete products must implement.
 * The method 'action' is expected to perform an action and return a string.
 */
interface FactoryMethod
{
    /**
     * Perform an action and return a string.
     *
     * @return string A string indicating the action completion.
     */
    public function action(): string;
}

/**
 * Class ConcreteFactoryMethod
 *
 * This class implements the FactoryMethod interface. It defines the action method
 * to perform a specific task and return a confirmation string.
 */
class ConcreteFactoryMethod implements FactoryMethod
{
    /**
     * Perform an action and return a string indicating action completion.
     *
     * @return string A string that confirms the action is completed.
     */
    public function action(): string
    {
        return "action completed";
    }
}

/**
 * Abstract Class Creator
 *
 * This abstract class declares the factory method that returns an object of type FactoryMethod.
 * It also includes a concrete method 'otherAction' that performs some other actions.
 */
abstract class Creator
{
    /**
     * The factory method that must be implemented by concrete subclasses.
     * This method should return an instance of a class that implements the FactoryMethod interface.
     *
     * @return FactoryMethod An instance of a class that implements FactoryMethod.
     */
    abstract public function factoryMethod(): FactoryMethod;

    /**
     * Perform some other actions and return an array of strings.
     *
     * @return array An array containing two strings: "other" and "action".
     */
    public function otherAction(): array
    {
        return ["other", "action"];
    }
}

/**
 * Class ConcreteCreator
 *
 * This class extends the abstract Creator class and implements the factoryMethod.
 * The factoryMethod returns an instance of ConcreteFactoryMethod.
 */
class ConcreteCreator extends Creator
{
    /**
     * Implementation of the factoryMethod that returns an instance of ConcreteFactoryMethod.
     *
     * @return FactoryMethod An instance of ConcreteFactoryMethod.
     */
    public function factoryMethod(): FactoryMethod
    {
        return new ConcreteFactoryMethod();
    }
}

/**
 * Function creator
 *
 * This function takes a Creator object as an argument and calls its otherAction method.
 * It returns the result of the otherAction method.
 *
 * @param Creator $creator An instance of a class that extends Creator.
 * @return array The result of calling the otherAction method on the Creator object.
 */
function creator(Creator $creator)
{
    return $creator->otherAction();
}

// Example usage of the Factory Method Design Pattern.
// Create an instance of ConcreteCreator and pass it to the creator function.
// Print the result of the otherAction method called on the ConcreteCreator instance.
print_r(creator(new ConcreteCreator()));
