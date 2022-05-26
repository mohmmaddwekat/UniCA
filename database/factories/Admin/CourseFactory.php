<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Data Structure', 'Algorithm', 'Operating Systems', 'General Physics', 'Discrete', 'Arabic', 'Mobile Apps', 'Computer Architecture', 'Introduction to Probability Theory', 'Writing technical', 'Database', 'Big Data', 'Calculus 1', 'Calculus 2', 'Feasibility study', 'Programming 1', 'Programming 2']),
            // 'name' => 'Programming 2',
            'semester' => 1,
            'year' => 2,
            'headDepartment_id' => 3,
            'prerequisite' => 1,
        ];
    }
}
