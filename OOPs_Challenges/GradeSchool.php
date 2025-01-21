<?php

class GradeSchool
{
    private $students = [];
    public function add(string $name, int $grade): void{
        $this->students[$grade][] = $name;
    }

    public function grade($grade) : array{
        //Nullish coalescing operator - if value is null or undefined returns []
        return $this->students[$grade] ?? [];
    }

    public function studentsByGradeAlphabetical(): array{
        //sorts the array with grade key 
        ksort($this->students);
        return array_map(function($grade){
            sort($grade);
            return $grade;
        },$this->students);
    }
}

$gradeSchool = new GradeSchool();
$gradeSchool->add('Holly',1);
$gradeSchool->add('Ben',1);
$gradeSchool->add('Nanny Plum',1);
$gradeSchool->add('King Thistle',2);
$gradeSchool->add('Queen Thistle',2);
$gradeSchool->add('Mr.Elf',2);
$gradeSchool->add('Mrs.Elf',5);

var_dump($gradeSchool->grade(2));
echo "<br>";
var_dump($gradeSchool->grade(4));
echo "<br>";
var_dump($gradeSchool->studentsByGradeAlphabetical());
echo "<br>";