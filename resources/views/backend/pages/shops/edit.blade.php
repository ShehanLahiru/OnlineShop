@extends('backend.layouts.app', [
    'namePage' => 'shops',
    'class' => 'sidebar-mini',
    'activePage' => 'shop',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pull-right">
                        <a href="{{ route('backend.shops.index') }}">
                            <button class="btn btn-dark" style="margin-right: 15px;">Back</button>
                        </a>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title"> Update Shop</h4>
                    </div>
                    <div class="card-body">
                        <form id="riddle_update" method="post" action="{{ route('backend.shops.update', $shop->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('backend.alerts.success')
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="name">{{__(" Name ")}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name',$shop->name) }}">
                                        @include('backend.alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="address">{{__(" Address")}}</label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address',$shop->address) }}">
                                        @include('backend.alerts.feedback', ['field' => 'address'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="contact_no">{{__(" Contact Number")}}</label>
                                        <input type="text" name="contact_no" class="form-control" value="{{ old('title_ta',$shop->contact_no) }}">
                                        @include('backend.alerts.feedback', ['field' => 'contact_no'])
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
