<?php

/*
|--------------------------------------------------------------------------
| Builder Design Pattern
|--------------------------------------------------------------------------
| Implement the Builder Design Pattern to create complex objects with 
| multiple steps. This pattern is useful when creating complex objects
| that require a controlled, step-by-step construction process.
| With the Builder pattern, different builders can create variations of 
| an object while using the same construction sequence.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/alirezajavadigit/Design-patterns
|--------------------------------------------------------------------------
*/

namespace Creational\Builder;

/**
 * The Product class represents the complex object that will be built.
 * In this example, a House object with various components.
 */
class House
{
    // Different components of the house
    public array $walls = [];
    public array $doors = [];
    public array $windows = [];
    public ?string $roof = null;

    /**
     * Display the details of the house that has been built.
     */
    public function show(): void
    {
        echo "House with " . count($this->walls) . " walls, " . count($this->doors) . " doors, " . count($this->windows) . " windows, and a " . ($this->roof ? "$this->roof roof" : "no roof") . ".\n";
    }
}

/**
 * The Builder interface declares the methods necessary to build each part of the product.
 * These methods will be implemented by concrete builder classes.
 */
interface HouseBuilder
{
    public function buildWalls(): void;
    public function buildDoors(): void;
    public function buildWindows(): void;
    public function buildRoof(): void;
    public function getHouse(): House;
}

/**
 * Concrete Builder for building a Wooden House.
 * This class implements the HouseBuilder interface and defines specific steps to
 * construct a house with wooden components.
 */
class WoodenHouseBuilder implements HouseBuilder
{
    private House $house;

    /**
     * Initialize a new House object.
     */
    public function __construct()
    {
        $this->house = new House();
    }

    /**
     * Build wooden walls for the house.
     */
    public function buildWalls(): void
    {
        $this->house->walls = array_fill(0, 4, 'wooden wall');
    }

    /**
     * Build wooden doors for the house.
     */
    public function buildDoors(): void
    {
        $this->house->doors = array_fill(0, 2, 'wooden door');
    }

    /**
     * Build windows with wooden frames for the house.
     */
    public function buildWindows(): void
    {
        $this->house->windows = array_fill(0, 4, 'wooden-framed window');
    }

    /**
     * Add a wooden roof to the house.
     */
    public function buildRoof(): void
    {
        $this->house->roof = 'wooden';
    }

    /**
     * Return the fully constructed house object.
     *
     * @return House The constructed house.
     */
    public function getHouse(): House
    {
        return $this->house;
    }
}

/**
 * Concrete Builder for building a Brick House.
 * This class implements the HouseBuilder interface and defines specific steps to
 * construct a house with brick and metal components.
 */
class BrickHouseBuilder implements HouseBuilder
{
    private House $house;

    /**
     * Initialize a new House object.
     */
    public function __construct()
    {
        $this->house = new House();
    }

    /**
     * Build brick walls for the house.
     */
    public function buildWalls(): void
    {
        $this->house->walls = array_fill(0, 4, 'brick wall');
    }

    /**
     * Build a metal door for the house.
     */
    public function buildDoors(): void
    {
        $this->house->doors = array_fill(0, 1, 'metal door');
    }

    /**
     * Build windows with brick frames for the house.
     */
    public function buildWindows(): void
    {
        $this->house->windows = array_fill(0, 6, 'brick-framed window');
    }

    /**
     * Add a metal roof to the house.
     */
    public function buildRoof(): void
    {
        $this->house->roof = 'metal';
    }

    /**
     * Return the fully constructed house object.
     *
     * @return House The constructed house.
     */
    public function getHouse(): House
    {
        return $this->house;
    }
}

/**
 * The Director class is responsible for controlling the building process.
 * It accepts a builder object and calls its methods in a specific sequence
 * to construct the complex object.
 */
class HouseDirector
{
    private HouseBuilder $builder;

    /**
     * Set the builder object that will be used for constructing the house.
     *
     * @param HouseBuilder $builder The builder responsible for construction.
     */
    public function setBuilder(HouseBuilder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * Direct the construction process by calling each build step in sequence.
     *
     * @return House The completed house.
     */
    public function constructHouse(): House
    {
        $this->builder->buildWalls();
        $this->builder->buildDoors();
        $this->builder->buildWindows();
        $this->builder->buildRoof();
        return $this->builder->getHouse();
    }
}

// Client Code
// Demonstrates the usage of the Builder pattern to construct different types of houses.

$director = new HouseDirector();

// Building a wooden house
$woodenHouseBuilder = new WoodenHouseBuilder();
$director->setBuilder($woodenHouseBuilder);
$woodenHouse = $director->constructHouse();
$woodenHouse->show(); // Outputs: House with 4 walls, 2 doors, 4 windows, and a wooden roof.

// Building a brick house
$brickHouseBuilder = new BrickHouseBuilder();
$director->setBuilder($brickHouseBuilder);
$brickHouse = $director->constructHouse();
$brickHouse->show(); // Outputs: House with 4 walls, 1 door, 6 windows, and a metal roof.
