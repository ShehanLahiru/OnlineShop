@extends('backend.layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit user',
    'activePage' => 'user',
    'activeNav' => '',
])

@section('content')
<div class="panel-header">
</div>
<div class="content">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('User Management') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('backend.users.index') }}"
                                class="btn btn-primary btn-round">{{ __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('backend.users.update', $user->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required autofocus>

                                        @include('backend.alerts.feedback', ['field' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}"
                                            required>
                                        @include('backend.alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="shop_id">{{__(" Shop")}}</label>
                                        <select class="form-control" id="category_id" name="shop_id">
                                            @foreach($shops as $shop)
                                            <option value="{{$shop->id}}" {{$shop->id==$user->shop_id?"selected":""}}>
                                                {{$shop->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('backend.alerts.feedback', ['field' => 'shop_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary btn-round">{{__('Update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
