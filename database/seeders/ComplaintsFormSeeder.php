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
                'user_id' =>'7',
                'headDepartment_id' => '5',
                'type' =>'withdraw',
                'course_number' => '12345678',
                'section'=>'2',
                'course_name'=>'سباحة',
                'teacher_name'=>'دكتور سباحة',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
            ],

             [
                'user_id' =>'7',
                'headDepartment_id' => '5',
                'type' =>'enroll',
                'course_number' => '12345688',
                'section'=>'1',
                'course_name'=>'102',
                'teacher_name'=>'dr 102',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'7',
                'headDepartment_id' => '5',
                'type' =>'withdraw',
                'course_number' => '12345888',
                'section'=>'2',
                'course_name'=>'101',
                'teacher_name'=>'dr 101',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'7',
                'headDepartment_id' => '5',
                'type' =>'enroll',
                'course_number' => '12348888',
                'section'=>'1',
                'course_name'=>'c++',
                'teacher_name'=>'دكتور c++',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],

             [
                'user_id' =>'8',
                'headDepartment_id' => '5',
                'type' =>'withdraw',
                'course_number' => '12345677',
                'section'=>'2',
                'course_name'=>'احياء',
                'teacher_name'=>'احياء دكتور ',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'12:30-02:00',
                'status'=>'In progress By the head of the department',
             ],
             [
                'user_id' =>'8',
                'headDepartment_id' => '5',
                'type' =>'enroll',
                'course_number' => '12345777',
                'section'=>'1',
                'course_name'=>'فيزياء',
                'teacher_name'=>'دكتور فيزياء',
                'days'=>'احد/ثلاثاء/اربعاء',
                'hour'=>'11:30-01:00',
                'status'=>'In progress By the head of the department',
             ],
             [
               'user_id' =>'9',
               'headDepartment_id' => '6',
               'type' =>'enroll',
               'course_number' => '12347777',
               'section'=>'5',
               'course_name'=>'رسم في الحاسوب',
               'teacher_name'=>'دكتور رسم في الحاسوب',
               'days'=>'احد/ثلاثاء/اربعاء',
               'hour'=>'11:30-01:00',
               'status'=>'In progress By the head of the department',
            ],

            [
               'user_id' =>'11',
               'headDepartment_id' => '10',
               'type' =>'enroll',
               'course_number' => '123456786',
               'section'=>'5',
               'course_name'=>'داتا بيس',
               'teacher_name'=>'دكتور داتا بيس',
               'days'=>'احد/ثلاثاء/اربعاء',
               'hour'=>'11:30-01:00',
               'status'=>'In progress By the head of the department',
            ],
            [
               'user_id' =>'11',
               'headDepartment_id' => '10',
               'type' =>'enroll',
               'course_number' => '123456766',
               'section'=>'5',
               'course_name'=>'داتا ستركشر',
               'teacher_name'=>'دكتور داتا ستركشر',
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
