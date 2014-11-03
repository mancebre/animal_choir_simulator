<?php

/**
 * Hierarchy of classes
 *
 * At the top of the hierarchy is the abstract class Animal.
 * Classes that define an animal (dog, cat, mouse) extends class Animal.
 * Class Choir at the bottom of the hierarchy, it is used to manage classes above it.
 */

/**
 * Class Animal
 *
 * @var string $type type of animal eg: cat, dog, mouse etc
 * @var string $loudness level of loudness
 * @var array $loudnessLevels allowed levels of loudness
 * @var string $noise animal sounds eg: bark, meow etc
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

abstract class Animal
{

    public $type;
    public $loudness;
    private $loudnessLevels = array('silent', 'normal', 'loud');
    protected $noise = null;

    /**
     *
     * @param string $type type of animal eg: cat, dog, mouse etc
     * @param string $loudness level of loudness
     * @throws Exception throws exception if $loudness is not member of $loudnessLevels array
     * @return \Animal
     */

    public function __construct($type, $loudness)
    {
        $this->type = $type;

        if (!in_array($loudness, $this->loudnessLevels)) {
            throw new Exception('Unknown loudness');
        }

        $this->loudness = $loudness;
    }

    /**
     * Returns animal sing depend on loudness level
     *
     * @throws Exception throws exception if $this->noise is not defined
     * @return string animal noise
     */
    public function sing()
    {

        if ($this->noise == null) {
            throw new Exception('Noise is not defined');
        }

        switch ($this->loudness) {
            case 'silent':
                return strtolower($this->noise);
                break;

            case 'normal':
                return ucfirst($this->noise);
                break;

            case 'loud':
                return strtoupper($this->noise);
                break;
        }
    }

    /**
     * @return string type of animal
     */

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string if animal noise is defined and null if not
     */

    public function getNoise()
    {
        return $this->noise;
    }
}

/**
 * Class Dog
 *
 * Extends class Animal and override variable noise
 *
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

class Dog extends Animal
{

    protected $noise = 'bark';

}

/**
 * Class Cat
 *
 * Extends class Animal and override variable noise
 *
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

class Cat extends Animal
{

    protected $noise = 'meow';

}

/**
 * Class Mouse
 *
 * Extends class Animal and override variable noise
 *
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

class Mouse extends Animal
{

    protected $noise = 'squeak';

}

/**
 * Class AnimalFactory
 *
 * Factory pattern that creates animals
 *
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

class AnimalFactory
{

    /**
     * Creates new animal using Animal class
     *
     * @param string $type type of animal eg: cat, dog, mouse etc
     * @param string $loudness level of loudness
     * @return mixed
     * @throws Exception throws exception if class Animal do not exist
     */

    public static function build($type, $loudness)
    {
        $animal = ucwords($type);
        if (class_exists($animal)) {
            return new $animal($type, $loudness);
        } else {
            throw new Exception("Invalid animal type given.");
        }
    }
}

/**
 * Class Choir
 *
 * Adding animals to groups and make them sing
 *
 * @author Djordje Mancovic <dj.mancovic@gmail.com>
 */

class Choir
{

    protected $singers = array();
    private $groupTypes = array('silent', 'normal', 'loud');


    /**
     * Adding animals to groups based on animal type and loudness level
     *
     * @param string $animal defines type of animal
     * @param string $loudness level of loudness
     * @throws Exception throws exception if $loudness is not member of $groupTypes array
     */

    public function addToGroups($animal, $loudness)
    {
        if (!in_array($loudness, $this->groupTypes)) {
            throw new Exception("Invalid group type given.");
        }

        $this->singers[$loudness][] = AnimalFactory::build($animal, $loudness);
    }

    /**
     * The choir start singing from the least loud singer group, and then are being joined
     * by more and more loud singer groups until they are singing all together.
     * The joining is represented with a new line.
     * Example:
     *      meow, squeak, bark
     *      Meow, bark, squeak, Bark, meow
     *      bark, Meow, MEOW, squeak, BARK, meow, Bark
     */

    public function crescendo()
    {
        $temp = array();
        foreach ($this->singers as $group) {
            foreach ($group as $singer) {
                $temp[] = $singer->sing();
            }

            shuffle($temp);

            echo join(', ', $temp);
            echo "<br/>";
        }
    }

    /**
     * The choir singer groups of the same loudness start singing one by one from
     * the least loud to the loudest
     * Example:
     *       meow, squeak, bark
     *       Meow, Bark
     *       MEOW, BARK
     */

    public function arpeggio()
    {
        foreach ($this->singers as $group) {
            $temp = array();
            foreach ($group as $singer) {
                $temp[] = $singer->sing();
            }

            echo join(', ', $temp);
            echo "<br/>";
        }

    }

}

/*Defining Class Choir*/
$choir = new Choir();

/*Adding animals to groups*/
$choir->addToGroups('Mouse', 'silent');
$choir->addToGroups('Dog', 'silent');
$choir->addToGroups('Cat', 'silent');
$choir->addToGroups('Dog', 'normal');
$choir->addToGroups('Cat', 'normal');
$choir->addToGroups('Dog', 'loud');
$choir->addToGroups('Cat', 'loud');

echo "<h3>Choir singing crescendo: </h3>";
$choir->crescendo();

echo "<br><br>";

echo "<h3>Choir singing arpeggio: </h3>";
$choir->arpeggio();
