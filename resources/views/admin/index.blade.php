@extends('layouts.admin.master')
@section('content')



<div class="row">

    <div class="col-xl-6 col-lg-6">
        <div class="card mb-4 progress-banner">
            <div class="card-body justify-content-between d-flex flex-row align-items-center">
                <div>
                    <i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                    <div>
                        <p class="lead text-white">{{ countTeachers() }} {{ __('admin/app.teachers') }}</p>

                    </div>
                </div>
                <div>
                    <div role="progressbar" class="progress-bar-circle progress-bar-banner position-relative" data-color="white" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="{{ countTeachers() }}" aria-valuemax="{{ countUsers() }}" data-show-percent="false">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="card mb-4 progress-banner">
            <a href="#" class="card-body justify-content-between d-flex flex-row align-items-center">
                <div>
                    <i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                    <div>
                        <p class="lead text-white"> {{ countStudents() }} {{ __('admin/app.students') }}</p>

                    </div>
                </div>
                <div>
                    <div role="progressbar" class="progress-bar-circle progress-bar-banner position-relative" data-color="white" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="{{ countStudents() }}" aria-valuemax="{{ countUsers() }}" data-show-percent="false">
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
