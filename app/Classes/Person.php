<?php

namespace App\Classes;

// Trait for logging
trait Logger {
    public function log(string $message): void {
        echo "[LOG]: $message\n";
    }
}

// Abstract class Shape
abstract class Shape {
    abstract public function calculateArea(): float;
}

// Circle class extending Shape
class Circle extends Shape {
    public float $radius;

    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    public function calculateArea(): float {
        return pi() * $this->radius ** 2;
    }
}

// Rectangle class extending Shape
class Rectangle extends Shape {
    public float $width;
    public float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea(): float {
        return $this->width * $this->height;
    }
}

// Person class
class Person {
    public string $name;
    private int $age;

    // Use Logger trait
    use Logger;

    // Constructor with name and age
    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->setAge($age);
        $this->log("New Person created: $this->name, Age: $this->age");
    }

    // Getter for age (encapsulation)
    public function getAge(): int {
        return $this->age;
    }

    // Setter for age (encapsulation)
    public function setAge(int $age): void {
        $this->age = $age;
    }

    // Method to return details
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
    public int $studentId;

    // Constructor with name, age, and studentId
    public function __construct(string $name, int $age, int $studentId) {
        parent::__construct($name, $age);
        $this->studentId = $studentId;
    }

    // Overridden getAge method to return just the age (integer)
    public function getAge(): int {
        return parent::getAge();
    }

    // Additional method to return student details with student ID (string format)
    public function getStudentDetails(): string {
        return "Name: $this->name, Age: " . $this->getAge() . ", Student ID: $this->studentId";
    }
}
?>