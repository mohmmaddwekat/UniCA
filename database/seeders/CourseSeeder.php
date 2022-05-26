<?php

namespace Database\Seeders;

use App\Models\Admin\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $courses = [
        [
            'id'=>1,
            'semester' => 1,
            'year' => 1,
            'name' => 'General Physics',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>2,
            'semester' => 1,
            'year' => 1,
            'name' => 'Discrete',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>3,
            'semester' => 1,
            'year' => 1,
            'name' => 'Calculus 1',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>4,
            'semester' => 1,
            'year' => 1,
            'name' => 'Programming Principles 1',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>5,
            'semester' => 2,
            'year' => 1,
            'name' => 'Writing technical',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>6,
            'semester' => 2,
            'year' => 1,
            'name' => 'Calculus 2',
            'headDepartment_id' => 1,
            'prerequisite' => 3,
        ],
        [
            'id'=>7,
            'semester' => 2,
            'year' => 1,
            'name' => 'Programming Principles 2',
            'headDepartment_id' => 1,
            'prerequisite' => 4,
        ],
        [
            'id'=>8,
            'semester' => 2,
            'year' => 1,
            'name' => 'Computer Structure',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>9,
            'semester' => 2,
            'year' => 1,
            'name' => 'probability theory',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>10,
            'semester' => 1,
            'year' => 2,
            'name' => 'Data Structure',
            'headDepartment_id' => 1,
            'prerequisite' => 7,
        ],
        [
            'id'=>11,
            'semester' => 1,
            'year' => 2,
            'name' => 'computer network',
            'headDepartment_id' => 1,
            'prerequisite' => 8,
        ],
        [
            'id'=>12,
            'semester' => 1,
            'year' => 2,
            'name' => 'Database',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>13,
            'semester' => 1,
            'year' => 2,
            'name' => 'Introduction to Statistical Analysis',
            'headDepartment_id' => 1,
            'prerequisite' => 9,
        ],
        [
            'id'=>14,
            'semester' => 1,
            'year' => 2,
            'name' => 'Web 1',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>15,
            'semester' => 2,
            'year' => 2,
            'name' => 'Algorithm',
            'headDepartment_id' => 1,
            'prerequisite' => 10,
        ],
        [
            'id'=>16,
            'semester' => 2,
            'year' => 2,
            'name' => 'Software Engineering',
            'headDepartment_id' => 1,
            'prerequisite' => 10,
        ],
        [
            'id'=>17,
            'semester' => 2,
            'year' => 2,
            'name' => 'Basic Artificial Intelligence',
            'headDepartment_id' => 1,
            'prerequisite' => 9,
        ],
        [
            'id'=>18,
            'semester' => 2,
            'year' => 2,
            'name' => 'Web 2',
            'track' => '',
            'headDepartment_id' => 1,
            'prerequisite' => 14,
        ],
        [
            'id'=>19,
            'semester' => 1,
            'year' => 3,
            'name' => 'Operating Systems',
            'headDepartment_id' => 1,
            'prerequisite' => 8,
        ],
        [
            'id'=>20,
            'semester' => 1,
            'year' => 3,
            'name' => 'Big Data',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>21,
            'semester' => 1,
            'year' => 3,
            'name' => 'Advanced Software',
            'track' => 'software',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>23,
            'semester' => 1,
            'year' => 3,
            'name' => 'UI/UX',
            'track' => 'software',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>24,
            'semester' => 1,
            'year' => 3,
            'name' => 'Information Retrieval',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 15,
        ],
        [
            'id'=>25,
            'semester' => 1,
            'year' => 3,
            'name' => 'Machine Learning 1',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 17,
        ],
        [
            'id'=>26,
            'semester' => 2,
            'year' => 3,
            'name' => 'Internet of Things',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>27,
            'semester' => 2,
            'year' => 3,
            'name' => 'Quality Assurance',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>28,
            'semester' => 2,
            'year' => 3,
            'name' => 'Feasibility Study',
            'track' => 'software',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>29,
            'semester' => 2,
            'year' => 3,
            'name' => 'Mobile Apps',
            'track' => 'software',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>30,
            'semester' => 2,
            'year' => 3,
            'name' => 'Natural Language Processing',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 25,
        ],
        [
            'id'=>31,
            'semester' => 2,
            'year' => 3,
            'name' => 'Machine Learning 2',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 25,
        ],
        [
            'id'=>32,
            'semester' => 2,
            'year' => 3,
            'name' => 'Data Mining',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 25,
        ],
        [
            'id'=>33,
            'semester' => 3,
            'year' => 3,
            'name' => 'Internship 1',
            'headDepartment_id' => 1,
            'prerequisite' => 10,
        ],
        [
            'id'=>34,
            'semester' => 1,
            'year' => 4,
            'name' => 'Internship 2',
            'headDepartment_id' => 1,
            'prerequisite' => 16,
        ],
        [
            'id'=>34,
            'semester' => 1,
            'year' => 4,
            'name' => 'Internship 2',
            'headDepartment_id' => 1,
            'prerequisite' => 33,
        ],
        [
            'id'=>35,
            'semester' => 1,
            'year' => 4,
            'name' => 'Innovation and Entrepreneurship',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>36,
            'semester' => 1,
            'year' => 4,
            'name' => 'Project management',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>37,
            'semester' => 1,
            'year' => 4,
            'name' => 'Image Processing',
            'track' => 'software',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>38,
            'semester' => 1,
            'year' => 4,
            'name' => 'data analysis',
            'track' => 'AI',
            'headDepartment_id' => 1,
            'prerequisite' => 12,
        ],
        [
            'id'=>39,
            'semester' => 2,
            'year' => 4,
            'name' => 'Internship 3',
            'headDepartment_id' => 1,
            'prerequisite' => 34,
        ],
        [
            'id'=>40,
            'semester' => 2,
            'year' => 4,
            'name' => 'Cloud Computing',
            'headDepartment_id' => 1,
        ],
        [
            'id'=>41,
            'semester' => 2,
            'year' => 4,
            'name' => 'Business automation',
            'track' => 'software',
            'headDepartment_id' => 1,
            'prerequisite' => 21,
        ],
        [
            'id'=>42,
            'semester' => 2,
            'year' => 4,
            'name' => 'Data storage',
            'track' => 'AI',
            'headDepartment_id' => 1,
        ],
    ];
    public function run()
    {
        //
        foreach ($this->courses as $course) {
            Course::create($course);
        }
    }
}
