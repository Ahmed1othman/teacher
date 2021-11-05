    @extends('layouts.admin.master')
@section('title')
    المنتجات
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin/app.'.$title) }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('admin/app.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin/app.'.$title) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            @include('message')
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <a href="{{route('product.create')}}" class="btn btn-success">اضافه منتج جديد</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered display">
                        <thead>
                        <tr class="footable-filtering">
                            <th>#</th>
                            <th data-toggle="true"> {{ __('admin/app.title') }} </th>
                            <th> {!! __('admin/app.description') !!} </th>
                            <th> {{ __('admin/app.image') }} </th>
                            <th> {{ __('admin/app.active') }} </th>
                            <th> {{ __('admin/app.price') }} </th>
                            <th> {{ __('admin/app.Category_id') }} </th>
                            <th data-hide="all"> {{ __('admin/app.action') }} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr id="row_{{$row->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->description }}</td>
                                <td>
                                    @if($row->file)
                                        @foreach($row->file as $image)
                                            <a href="{{asset('storage/products/'.$image->filename)}}"
                                               data-fancybox="group2">
                                                <img width="75px" height="50px"
                                                     src="{{asset('storage/products/'.$image->filename)}}" class="">
                                            </a>
                                            @break;
                                        @endforeach
                                    @endif

                                </td>
                                <td>{!! $row->active==1?'<i class="fa fa-check-circle text-success" aria-hidden="true"></i>':'<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>'!!}</td>

                                <td>{{number_format($row->price,2)}}</td>
                                <td>{{ $row->category->name }}</td>

                                <td>
                                    <a href="{{route('product.edit',$row->id)}}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            onclick="delete_alert({{$row->id}},'product')"><i class="fas fa-trash"></i>
                                    </button>
                                    <a href="{{route('product.show',$row->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
