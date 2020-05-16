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
                        <h4 class="card-title"> Update Items</h4>
                    </div>
                    <div class="card-body">
                        <form id="hand_work_update" method="post" action="{{ route('backend.items.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('backend.alerts.success')
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="name">{{__(" Name")}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name',$item->name) }}">
                                        @include('backend.alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="description">{{__(" Description")}}</label>
                                        <textarea rows="10" type="text" name="description" class="form-control"
                                                  style="border:1px solid #E3E3E3">{{ old('content_en',$item->description) }}</textarea>
                                        @include('backend.alerts.feedback', ['field' => 'description'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="price">{{__(" Price")}}</label>
                                        <input type="text" name="price" class="form-control" value="{{ old('price',$item->price) }}">
                                        @include('backend.alerts.feedback', ['field' => 'price'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="discount">{{__(" Discount")}}</label>
                                        <input type="text" name="discount" class="form-control" value="{{ old('discount',$item->discount) }}">
                                        @include('backend.alerts.feedback', ['field' => 'discount'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="category_id">{{__(" Item Categories")}}</label>
                                        <select class="form-control" id="category_id" name="category_id" >
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"{{$category->id==$item->category_id?"selected":""}}>{{$category->name}}</option>
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
                                        <select class="form-control" id="category_id" name="shop_id" >
                                            @foreach($shops as $shop)
                                                <option value="{{$shop->id}}"{{$shop->id==$item->shop_id?"selected":""}}>{{$shop->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'shop_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="quantity_type">{{__(" Quantity")}}</label>
                                        <select class="form-control" id="quantity_type" name="quantity_type" >
                                            <option {{$item->quantity_type == 'piece' ? 'selected' : ''}}  value="piece">piece</option>
                                            <option {{$item->quantity_type == 'loose' ? 'selected' : ''}}  value="loose">loose</option>
                                            <option {{$item->quantity_type == 'liquide' ? 'selected' : ''}}  value="liquide">liquide</option>
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
                                                value="{{ old('discount',$item->quantityPiece) }}">
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
                                                        value="{{ old('discount',$item->quantityKg) }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityKg'])
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="quantityg">{{__(" g ")}}</label>
                                                        <input type="text" name="quantityg" class="form-control"
                                                        value="{{ old('discount',$item->quantityg) }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityg'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>If Quantity type is liquide</p>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="quantityL">{{__(" L ")}}</label>
                                                        <input type="text" name="quantityL" class="form-control"
                                                        value="{{ old('discount',$item->quantityL) }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityL'])
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="quantityMl">{{__(" ML ")}}</label>
                                                        <input type="text" name="quantityMl" class="form-control"
                                                        value="{{ old('discount',$item->quantityMl) }}">
                                                        @include('backend.alerts.feedback', ['field' => 'quantityMl'])
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
                                        <label class="d-block" for="image">{{__(" Image")}}</label>
                                        <img class="gal-img prev_img" id="prev_img2" src="{{$item->image_url!=null?$item->image_url:('assets/img/dummy.jpg')}}">
                                        <input type="file" class="custom-file-input2" name="image" id="custom-file-input2" >
                                        @include('backend.alerts.feedback', ['field' => 'image'])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary btn-round">{{__('Update')}}</button>
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
    {{--    {!! JsValidator::formRequest('App\Http\Requests\CMS\AdCreateRequest', '#traditional_song_update') !!}--}}
@endsection
