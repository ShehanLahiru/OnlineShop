@extends('backend.layouts.app', [
    'namePage' => 'Items',
    'class' => 'sidebar-mini',
    'activePage' => 'item',
  ])



@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pull-right">
                        <a href="{{ route('backend.items.index') }}">
                            <button class="btn btn-dark" style="margin-right: 15px;">Back</button>
                        </a>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title"> Add Item</h4>
                    </div>
                    <div class="card-body">
                        <form id="hand_work_create" method="post" action="{{ route('backend.items.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('backend.alerts.success')
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="name">{{__(" Name")}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @include('backend.alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="description">{{__(" Description")}}</label>
                                        <textarea rows="10" type="text" name="description" class="form-control"
                                                  style="border:1px solid #E3E3E3">{{ old('description') }}</textarea>
                                        @include('backend.alerts.feedback', ['field' => 'description'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="price">{{__(" Price")}}</label>
                                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                                        @include('backend.alerts.feedback', ['field' => 'price'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="discount">{{__(" Discount Percentage")}}</label>
                                        <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
                                        @include('backend.alerts.feedback', ['field' => 'discount'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="category_id">{{__(" Item Category")}}</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'category_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="shop_id">{{__(" Shop")}}</label>
                                        <select class="form-control" id="shop_id" name="shop_id">
                                            @foreach($shops as $shop)
                                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'shop_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="quantity_type">{{__(" Quantity Type")}}</label>
                                        <select class="form-control" id="quantity_type" name="quantity_type">
                                            <option value="piece">piece</option>
                                            <option value="loose">loose</option>
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'shop_id'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="quantityPiece">{{__(" If Quantity type is Piece ")}}</label>
                                                <input type="text" size="50"  name="quantityPiece" class="form-control"
                                                    value="{{ old('quantityPiece') }}">
                                                @include('backend.alerts.feedback', ['field' => 'quantitypiece'])
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>If Quantity type is loose</p>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="quantityKg">{{__(" Kg ")}}</label>
                                                        <input type="text" name="quantityKg" class="form-control"
                                                            value="{{ old('quantityKg') }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityKg'])
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="quantityg">{{__(" g ")}}</label>
                                                        <input type="text" name="quantityg" class="form-control"
                                                            value="{{ old('quantityg') }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityg'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label class="d-block" for="title">{{__(" Image")}}</label>
                                        <img class="gal-img prev_img" id="prev_img" src="{{asset('assets/img/dummy.jpg')}}">
                                        <input type="file" class="custom-file-input" name="image" id="custom-file-input" >
                                        @include('backend.alerts.feedback', ['field' => 'image_url'])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary btn-round">{{__('Create')}}</button>
                            </div>
                            <hr class="half-rule"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <!-- Laravel Javascript Validation -->--}}
    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\CMS\AdCreateRequest', '#traditional_song_create') !!}--}}
@endsection
