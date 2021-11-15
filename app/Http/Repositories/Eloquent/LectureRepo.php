<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\LectureRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Lecture;



class LectureRepo extends AbstractRepo implements LectureRepoInterface
{
    public function __construct()
    {
        parent::__construct(Lecture::class);
    }



}
