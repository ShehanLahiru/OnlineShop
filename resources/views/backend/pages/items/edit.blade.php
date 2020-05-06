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
                                        <label for="quantity">{{__(" Quantity")}}</label>
                                        <input type="text" name="quantity" class="form-control" value="{{ old('quantity',$item->quantity) }}">
                                        @include('backend.alerts.feedback', ['field' => 'quantity'])
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
                                            <option {{$item->quantity_type == 'piece' ? 'selected' : ''}}  value="draft">piece</option>
                                            <option {{$item->quantity_type == 'loose' ? 'selected' : ''}}  value="published">loose</option>
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'shop_id'])
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
