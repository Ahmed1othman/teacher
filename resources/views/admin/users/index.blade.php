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
                                <th>{{ __('admin/app.name') }}</th>
                                <th>{{ __('admin/app.phone') }}</th>
                                <th>{{ __('admin/app.rate') }}</th>
                                <th>{{ __('admin/app.email') }}</th>
                                <th>{{ __('admin/app.type') }}</th>
                                <th>{{ __('admin/app.preliminary') }}</th>
                                <th>{{ __('admin/app.preparatory') }}</th>
                                <th>{{ __('admin/app.secondary') }}</th>
                                <th>{{ __('admin/app.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td> {{ $row->name }}  </td>
                                <td> {{ $row->phone }} </td>
                                <td> {{ $row->rate }} <i class="simple-icon-star text-warning" aria-hidden="true"></i> </td>
                                <td> {{ $row->email }} </td>
                                <td> {{ $row->type }} </td>
                                <td>
                                    @if($row->type=='teacher')
                                    <div class="custom-switch custom-switch-primary mb-2">
                                        <input class="custom-switch-input" id="preliminary_{{ $row->id }}" {{ $row->preliminary==1?'checked':'' }} value="{{ $row->preliminary==1?0:1 }}" name="preliminary" type="checkbox">
                                        <label class="custom-switch-btn" onclick="changeCategory({{ $row->id }},'preliminary')" ></label>
                                     </div>
                                     @endif
                                    </td>
                                    <td>
                                    @if($row->type=='teacher')

                                        <div class="custom-switch custom-switch-primary mb-2">
                                        <input class="custom-switch-input" id="preparatory_{{ $row->id }}" {{ $row->preparatory==1?'checked':'' }} value="{{ $row->preparatory==1?0:1 }}" name="preparatory" type="checkbox">
                                        <label class="custom-switch-btn" onclick="changeCategory({{ $row->id }},'preparatory')"  ></label>
                                     </div>
                                     @endif
                                </td>
                                <td>
                                    @if($row->type=='teacher')

                                    <div class="custom-switch custom-switch-primary mb-2">
                                        <input class="custom-switch-input" id="secondary_{{ $row->id }}" {{ $row->secondary==1?'checked':'' }} value="{{ $row->secondary==1?0:1 }}" name="secondary" type="checkbox">
                                        <label class="custom-switch-btn" onclick="changeCategory({{ $row->id }},'secondary')"  ></label>
                                     </div>
                                     @endif
                                </td>
                                <td>
                                    <div class="custom-switch custom-switch-primary mb-2">
                                        <input class="custom-switch-input" id="active_{{ $row->id }}" {{ $row->active==1?'checked':'' }} value="{{ $row->active==1?0:1 }}" name="active" type="checkbox">
                                        <label class="custom-switch-btn" onclick="modelActive({{ $row->id }},'users')" ></label>
                                    </div>

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




