<?php

namespace App\Http\Controllers;

use App\Classes\Person;
use App\Classes\Student;
use App\Classes\Circle;
use App\Classes\Rectangle;

class PersonController extends Controller
{
    public function show()
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

        // Return a view or output the results (for now, let's output them directly)
        return response()->json([
            'person1' => $person1Details,
            'person2' => $person2Details,
            'student' => $studentDetails,
            'averageAge' => $averageAge,
            'circleArea' => $circleArea,
            'rectangleArea' => $rectangleArea
        ]);
    }
}
?>