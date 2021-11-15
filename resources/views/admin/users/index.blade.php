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
                                @foreach ($categories as $category)
                                <th>{{ $category->name }}</th>
                                @endforeach
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
                                @foreach ($categories as $category)
                                <td>
                                    <div class="custom-switch custom-switch-primary mb-2">
                                        <input class="custom-switch-input" id="category_{{ $category->id }}_{{ $row->id }}" {{ categoriesDetails($category->id,$row->id)?'checked':'' }} value="{{ categoriesDetails($category->id,$row->id)?0:1 }}" name="preliminary" type="checkbox">
                                        <label class="custom-switch-btn" onclick="changeCategory({{ $category->id }},{{ $row->id }},'preliminary')" ></label>
                                     </div>
                                </td>
                                @endforeach
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




