<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\AppointmentRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Appointment;



class AppointmentRepo extends AbstractRepo implements AppointmentRepoInterface
{
    public function __construct()
    {
        parent::__construct(Appointment::class);
    }



}
