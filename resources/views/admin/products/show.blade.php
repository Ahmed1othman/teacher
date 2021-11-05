@extends('layouts.admin.master')
@section('title')
{{__('admin/product.details')}}
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
    <div class="container-fluid ">
        <div class="card">
            <div class="card-header text-center">
                {{__('admin/product.information')}} {{$row->title}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.name')}}</label>
                        <input type="text" readonly value="{{$row->title}}" class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.notes')}}</label>
                        <input type="text" readonly value="{{$row->description}}" class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.price')}}</label>
                        <input type="text" readonly value="{{$row->price}}" class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.offer_price')}}</label>
                        <input type="text" readonly value="{{$row->offer_price}}" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.discount')}}</label>
                        <input type="text" readonly value="{{$row->discount}}" class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.status')}}</label>
                        <input type="text" readonly value="{{$row->active == 1 ? 'مفعل' : 'غير مفعل'}}"
                               class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.category')}}</label>
                        <input type="text" readonly value="{{$row->category->name}}" class="form-control">
                    </div>
                    <div class="col">
                        <label>{{__('admin/product.is_auction')}}</label>
                        <input type="text" readonly value="{{$row->is_auction == 1 ? 'مفعل مزاد' : 'غير مفعل'}}"
                               class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    @foreach($details->product_specification as $detail)
                        <div class="col-3 mb-1">
                            <label>{{__('admin/product.product_specification')}}</label>
                            <input type="text" readonly value="{{$detail->key}}" class="form-control">
                        </div>

                        <div class="col-3 mb-1">
                            <label>{{__('admin/product.product_value')}}</label>
                            <input type="text" readonly value="{{$detail->value}}" class="form-control">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                {{__('admin/product.photoHome')}} {{$row->title}}
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.photoHome')}}</label>
                        <div class="card-img">
                            @if ($row->image)
                                <a href="{{asset($row->image)}}" data-fancybox="group2">
                                    <img width="250px" height="100px" src="{{asset($row->image)}}"
                                         alt="{{$row->title}}" class="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">
                {{__('admin/product.photo')}} {{$row->title}}
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.photo')}}</label>
                        <div class="card-img">
                            @if($row->file)
                                @foreach($row->file as $image)
                                    <a href="{{asset('storage/products/'.$image->filename)}}"
                                       data-fancybox="group2">
                                        <img width="150px" height="100px"
                                             src="{{asset('storage/products/'.$image->filename)}}" class="ml-2">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
