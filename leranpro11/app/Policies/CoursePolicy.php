<?php

namespace App\Policies;

use App\Models\User;

class CoursePolicy
{
 
    public function create(User $user)
    {
        return $user->role === 'instructor';
    }

    public function enroll(User $user, Course $course)
    {
        return $user->role === 'student';
    }




}
