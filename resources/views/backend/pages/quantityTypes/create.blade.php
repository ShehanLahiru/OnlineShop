@extends('backend.layouts.app', [
    'namePage' => 'quantityTypes',
    'class' => 'sidebar-mini',
    'activePage' => 'quantityTypes',
  ])


@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pull-right">
                        <a href="{{ route('backend.quantityTypes.index') }}">
                            <button class="btn btn-dark" style="margin-right: 15px;">Back</button>
                        </a>
                    </div>
                    <div class="card-header">
                        <h4 class="card-title"> Create Quantity Type</h4>
                    </div>
                    <div class="card-body">
                        <form id="category_create" method="post" action="{{ route('backend.quantityTypes.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('backend.alerts.success')
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="name">{{__("Name")}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @include('backend.alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="unit1">{{__("unit1")}}</label>
                                        <input type="text" name="unit1" class="form-control" value="{{ old('unit1') }}">
                                        @include('backend.alerts.feedback', ['field' => 'unit1'])
                                    </div>
                                </div>
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="name">{{__("Unit2")}}</label>
                                        <input type="text" name="unit2" class="form-control" value="{{ old('unit2') }}">
                                        @include('backend.alerts.feedback', ['field' => 'unit2'])
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
    {{--    {!! JsValidator::formRequest('App\Http\Requests\CMS\AdCreateRequest', '#riddle_create') !!}--}}
@endsection
