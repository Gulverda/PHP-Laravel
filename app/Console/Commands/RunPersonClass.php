<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Person;
use App\Classes\Student;
use App\Classes\Circle;
use App\Classes\Rectangle;

class RunPersonClass extends Command
{
    // The name and signature of the console command.
    protected $signature = 'run:person';

    // The console command description.
    protected $description = 'Run the Person and Student classes';

    // Execute the console command.
    public function handle()
    {
        // Create Person and Student instances
        $person1 = new Person("John Doe", 30);
        $person2 = new Person("Jane Doe", 25);
        $student = new Student("Alice", 20, 12345);

        // Output their details
        $person1Details = $person1->getDetails();
        $person2Details = $person2->getDetails();
        $studentDetails = $student->getStudentDetails();

        // Calculate average age
        $people = [$person1, $person2, $student];
        $averageAge = Person::calculateAverageAge($people);

        // Create shapes and calculate areas
        $circle = new Circle(5);
        $rectangle = new Rectangle(4, 6);
        $circleArea = $circle->calculateArea();
        $rectangleArea = $rectangle->calculateArea();

        // Output the results
        $this->info("Person 1: $person1Details");
        $this->info("Person 2: $person2Details");
        $this->info("Student: $studentDetails");
        $this->info("Average Age: $averageAge");
        $this->info("Circle Area: $circleArea");
        $this->info("Rectangle Area: $rectangleArea");

        return 0;
    }
}
?>