<?php

namespace App\BO\Transformations;

use App\BO\Models\Course;

trait CourseTransformable
{
    public function transformCoursetDet(Course $course)
    {
        $obj = new Course();
        $obj->id = $course->id;
        $obj->course_name = $course->course_name;
        $obj->course_code = $course->course_code;
        $obj->credits = $course->credits;
        $obj->course_fee = $course->course_fee;
        $obj->course_fee_format = number_format($course->course_fee, 2, ".", "");
        return $obj;
    }

}
