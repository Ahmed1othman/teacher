@extends('layouts.admin.master')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>{{ __('admin/app.user_management') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('admin/app.teacher') }}</th>
                                <th>{{ __('admin/app.student') }}</th>
                                <th>{{ __('admin/app.type') }}</th>
                                <th>{{ __('admin/app.status') }}</th>
                                <th>{{ __('admin/app.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td> {{ $row->appointment->teacher->name }}  </td>
                                <td> {{ $row->student->name }}  </td>
                                <td> {{ $row->appointment->type }}  </td>
                                <td> <span id="status_{{ $row->id }}"> {{ $row->status }}</span> </td>
                                <td>
                                    <button type="button"  onclick="changeProjectStatus({{ $row->id }},'accepted')" class="btn btn-success">{{ __('admin/app.accept') }}</button>
                                    <button type="button"  onclick="changeProjectStatus({{ $row->id }},'canceled')" class="btn btn-danger">{{ __('admin/app.reject') }}</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




