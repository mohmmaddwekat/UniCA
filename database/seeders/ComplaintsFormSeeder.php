<?php

namespace Database\Seeders;

use App\Models\Complaint\ComplaintsForm;
use Illuminate\Database\Seeder;

class ComplaintsFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //	user_id	headDepartment_id	type	course_number	section	course_name	teacher_name	days	hour	status
        $complaints = [
            [
                'user_id' =>'5',
                'headDepartment_id' => '3',
                'type' =>'withdraw',
                'course_number' => '12345678',
                'section'=>'2',
                'course_name'=>'عربي',
                'teacher_name'=>'دكتور عربي',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'5',
                'headDepartment_id' => '3',
                'type' =>'enroll',
                'course_number' => '321654987',
                'section'=>'1',
                'course_name'=>'فيزياء',
                'teacher_name'=>'دكتور فيزياء',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'6',
                'headDepartment_id' => '3',
                'type' =>'withdraw',
                'course_number' => '12345678',
                'section'=>'2',
                'course_name'=>'عربي',
                'teacher_name'=>'دكتور عربي',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'7',
                'headDepartment_id' => '3',
                'type' =>'enroll',
                'course_number' => '321654987',
                'section'=>'1',
                'course_name'=>'فيزياء',
                'teacher_name'=>'دكتور فيزياء',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],

             [
                'user_id' =>'8',
                'headDepartment_id' => '4',
                'type' =>'withdraw',
                'course_number' => '12345678',
                'section'=>'2',
                'course_name'=>'عربي',
                'teacher_name'=>'دكتور عربي',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'8',
                'headDepartment_id' => '4',
                'type' =>'enroll',
                'course_number' => '321654987',
                'section'=>'1',
                'course_name'=>'فيزياء',
                'teacher_name'=>'دكتور فيزياء',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],
        ];

        foreach($complaints as $complaint){
            ComplaintsForm::create($complaint);
        }


    }
}