@extends('layouts.admin.master')
@section('title')
{{__('admin/product.AddProducts')}}
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
                        {{__('admin/product.product')}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('product.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col">
                            <label>{{__('admin/product.product_ar')}}</label>
                            <input type="text" class="form-control myInput_ar @error('title') is-invalid @enderror" name="title" required value="{{old('title')}}">
                            @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{__('admin/product.product_en')}}</label>
                            <input type="text" class="form-control myInput_en @error('title_en') is-invalid @enderror" name="title_en" required value="{{old('title_en')}}">
                            @error('title_en')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{__('admin/product.note_ar')}}</label>
                            <textarea name="description" required class="form-control myInput_ar @error('description') is-invalid @enderror" rows="5">{{old('description')}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{__('admin/product.note_en')}}</label>
                            <textarea name="description_en" required class="form-control myInput_en @error('description_en') is-invalid @enderror" rows="5">{{old('description_en')}}</textarea>
                            @error('description_en')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{__('admin/product.category')}}</label>
                            <select name="category_id" id="" class="form-control" required>
                                <option value="" disabled selected> -- {{__('admin/product.choose')}} --</option>
                                @foreach($Categories as $Categorie)
                                    <option value="{{$Categorie->id}}">{{$Categorie->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{__('admin/product.price')}}</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" required>
                            @error('price')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{__('admin/product.offer_price')}}</label>
                            <input type="number" class="form-control @error('offer_price') is-invalid @enderror" name="offer_price" value="{{old('offer_price')}}" required>
                            @error('offer_price')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label>{{__('admin/product.discount')}}</label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{old('discount')}}" required>
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
                                    <h4 class="card-title">{{__('admin/product.photoHome')}}</h4>
                                    <h6 class="card-subtitle text-danger">{{__('admin/product.photo_image_required')}}</h6>
                                    <div class="fallback">
                                        <input name="cover_photo" type="file" accept="image/*" required>
                                    </div>
                                    @error('cover_photo')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{__('admin/product.photo')}}</h4>
                                <h6 class="card-subtitle text-danger">{{__('admin/product.photo_image_required')}}</h6>
                                <div class="fallback">
                                    <input name="photos[]" type="file" accept="image/*" required multiple>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <br>


                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-t-20">{{__('admin/product.status')}}</h4>
                                    <div class="m-b-30">
                                        <input name="active" id="active" type="checkbox"
                                               class="form-control input-shadow @error('active') is-invalid @enderror"
                                               placeholder="{{ __('admin/app.active') }}" aria-label="active"
                                               onchange="checkActive()" value="1">
                                        <input id='testActiveHidden' type='hidden' value='0' name='active'>
                                        @error('active')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
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
                                                <div data-repeater-item class="row m-b-15">
                                                    <div class="col">
                                                        <input type="text" required name="key" class="form-control mb-2" placeholder="الاسم بالغه الانجلزيئه">
                                                        <input type="text" required name="key_ar" class="form-control mb-2" placeholder="الاسم بالغه العربيه">
                                                    </div>

                                                    <div class="col">
                                                        <input type="text" required name="value" class="form-control mb-2" placeholder="الوصف بالغه الانجلزيئه">
                                                        <input type="text" required name="value_ar" class="form-control mb-2" placeholder="الوصف بالغه العربيه">
                                                    </div>
                                                    <div class="col">
                                                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" data-repeater-create="" class="btn btn-info waves-effect waves-light"> اضف جديد
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success" type="submit">حفظ البيانات</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
