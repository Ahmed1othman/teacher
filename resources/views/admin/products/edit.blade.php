@extends('layouts.admin.master')
@section('title')
تعديل المنتج
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
        <div class="card-header text-center text-primary h-5">
            <div class="row">
                <div class="col">
                    اضافه منتج جديد
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('product.update','test')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="id" value="{{$row->id}}">

                <div class="row">

                    <div class="col">
                        <label>{{__('admin/product.product_ar')}}</label>
                        <input type="text" class="form-control myInput_ar @error('title') is-invalid @enderror" name="title" value="{{ $row->getTranslation('title', 'ar') }}">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{__('admin/product.product_en')}}</label>
                        <input type="text" class="form-control myInput_en @error('title_en') is-invalid @enderror" name="title_en" value="{{ $row->getTranslation('title', 'en') }}">
                        @error('title_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.note_ar')}}</label>
                        <textarea name="description" class="form-control myInput_ar @error('description') is-invalid @enderror" rows="5">{{ $row->getTranslation('description', 'ar') }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{__('admin/product.note_en')}}</label>
                        <textarea name="description_en" class="form-control myInput_en @error('description_en') is-invalid @enderror" rows="5">{{ $row->getTranslation('description', 'en') }}</textarea>
                        @error('description_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <label>{{__('admin/product.category')}}</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach($Categories as $Categorie)
                            <option value="{{$Categorie->id}}" {{$Categorie->id == $row->category_id ? 'selected' : ''}}>{{$Categorie->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{__('admin/product.price')}}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$row->price}}">
                        @error('price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{__('admin/product.offer_price')}}</label>
                        <input type="number" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price" value="{{$row->offer_price}}">
                        @error('offer_price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label>{{__('admin/product.discount')}}</label>
                        <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{$row->discount}}">
                        @error('discount')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                @if ($row->image)
                                <a href="{{asset($row->image)}}" data-fancybox="group2">
                                    <img width="75px" height="75px" src="{{asset($row->image)}}" alt="{{$row->title}}" class="">
                                </a>
                                @endif
                                <h4 class="card-title">{{__('admin/product.photoHome')}}</h4>
                                <h6 class="card-subtitle text-danger">{{__('admin/product.photo_image_required')}}</h6>
                                <div class="fallback">
                                    <input name="cover_photo" type="file" accept="image/*">
                                </div>
                                @error('cover_photo')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>

                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            @foreach($row->file as $image)
                            <a href="{{asset('storage/products/'.$image->filename)}}">
                                <img width="100px" height="80px" src="{{asset('storage/products/'.$image->filename)}}" class="ml-1">
                            </a>
                            @endforeach


                            <input name="savephoto" id="savephoto" type="checkbox" class="form-control input-shadow @error('active') is-invalid @enderror" checked value="1">
                            <span class="text-success">{{__('admin/product.Deleted_photo')}}</span>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('admin/product.photo')}}</h4>
                                <h6 class="card-subtitle text-danger">{{__('admin/product.photo_image_required')}}</h6>

                                <div class="fallback">
                                    <input name="photos[]" type="file" accept="image/*" multiple>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <br>


                <div class="row">
                    <div class="col">
                        <h4 class="card-title m-t-20">{{__('admin/product.status')}}</h4>
                        <div class="m-b-30">
                            <input name="active" id="active" type="checkbox" class="form-control input-shadow @error('active') is-invalid @enderror" placeholder="{{ __('admin/app.active') }}" aria-label="active" onchange="checkActive()" value="1" {{ $row->active==1?'checked':'' }}>
                            <input id='testActiveHidden' type='hidden' disabled value='0' name='active'>
                            @error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="container-fluid">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('admin/product.product_specification')}}</h4>
                                <div class="">
                                    <div class="specify-repeater form-group">
                                        <div data-repeater-list="repeater_groups">
                                            @foreach($details->product_specification as $detail)
                                            <div data-repeater-item class="row m-b-15">
                                                <div class="col">
                                                    <input type="text" required name="key" value="{{$detail->getTranslation('key','en')}}" class="form-control mb-2">
                                                    <input type="text" required name="key_ar" value="{{$detail->getTranslation('key','ar')}}" class="form-control mb-2">
                                                </div>
                                                <div class="col">
                                                    <input type="text" required name="value" value="{{$detail->getTranslation('value','en')}}" class="form-control mb-2">
                                                    <input type="text" required name="value_ar" value="{{$detail->getTranslation('value','ar')}}" class="form-control mb-2">
                                                </div>
                                                <div class="col">
                                                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" data-repeater-create="" class="btn btn-info waves-effect waves-light"> {{__('admin/product.Add_new')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <button class="btn btn-success" type="submit">{{__('admin/product.Edit')}}</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection
