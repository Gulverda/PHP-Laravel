<?php

namespace App\Classes;

// Task 7: Logger Trait
trait Logger {
    public function log(string $message): void {
        echo "[LOG]: $message\n";
    }
}

// Task 13: Movable Trait
trait Movable {
    public function move(int $x, int $y): void {
        echo "[MOVE]: Moved to ($x, $y)\n";
    }
}

// Task 13: Scalable Trait
trait Scalable {
    public function scale(float $factor): void {
        echo "[SCALE]: Scaled by a factor of $factor\n";
    }
}

// Task 10: Resizable Interface
interface Resizable {
    public function resize(float $factor): void;
}

// Task 9: Abstract class Shape
abstract class Shape {
    // Task 14: Overloading calculateArea method
    abstract public function calculateArea(float $arg1 = 0, float $arg2 = 0): float;

    // Task 15: Exception handling for invalid inputs
    protected function validateDimensions(float $dimension): void {
        if ($dimension < 0) {
            throw new \Exception("Dimension cannot be negative.");
        }
    }
}

// Circle class implementing Shape and Resizable
class Circle extends Shape implements Resizable {
    public float $radius;

    // Task 13: Using Movable and Scalable traits
    use Movable, Scalable;

    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    // Task 10: Implement resize method
    public function resize(float $factor): void {
        $this->radius *= $factor;
        echo "[RESIZE]: Circle resized to radius: $this->radius\n";
    }

    // Task 9: Implement calculateArea
    public function calculateArea(float $radius = 0, float $arg2 = 0): float {
        $this->validateDimensions($this->radius);
        return pi() * $this->radius ** 2;
    }
}

// Rectangle class implementing Shape and Resizable
class Rectangle extends Shape implements Resizable {
    public float $width;
    public float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    // Task 10: Implement resize method
    public function resize(float $factor): void {
        $this->width *= $factor;
        $this->height *= $factor;
        echo "[RESIZE]: Rectangle resized to width: $this->width and height: $this->height\n";
    }

    // Task 9: Implement calculateArea
    public function calculateArea(float $width = 0, float $height = 0): float {
        $this->validateDimensions($this->width);
        $this->validateDimensions($this->height);
        return $this->width * $this->height;
    }
}

// Person class
class Person {
    public string $name;
    private int $age;

    // Use Logger trait
    use Logger;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->setAge($age);
        $this->log("New Person created: $this->name, Age: $this->age");
    }

    // Getter for age
    public function getAge(): int {
        return $this->age;
    }

    // Setter for age
    public function setAge(int $age): void {
        $this->age = $age;
    }

    public function getDetails(): string {
        return "Name: $this->name, Age: " . $this->getAge();
    }

    // Static method to calculate average age
    public static function calculateAverageAge(array $people): float {
        $totalAge = 0;
        foreach ($people as $person) {
            $totalAge += $person->getAge();
        }
        return $totalAge / count($people);
    }
}

// Student class extending Person
class Student extends Person {
    // Task 12: Change studentId visibility to protected
    protected int $studentId;

    public function __construct(string $name, int $age, int $studentId) {
        parent::__construct($name, $age);
        $this->studentId = $studentId;
    }

    // Getter for studentId (Task 12: Encapsulation)
    public function getStudentId(): int {
        return $this->studentId;
    }

    // Overridden method getAge to return only age
    public function getAge(): int {
        return parent::getAge();
    }

    // Additional method to return student details
    public function getStudentDetails(): string {
        return "Name: $this->name, Age: " . $this->getAge() . ", Student ID: $this->studentId";
    }
}

// Task 11: Polymorphism example
$shapes = [
    new Circle(5),
    new Rectangle(10, 5),
];

foreach ($shapes as $shape) {
    echo "Area: " . $shape->calculateArea() . "\n";
}

?>