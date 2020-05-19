@extends('backend.layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Orders',
'activePage' => 'orders',
'activeNav' => 'orders',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{__("Order")}}</h5>
                    <form method="post" action="{{ route('backend.changeStatus',$order->id) }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="filter" name="status">
                                        <option {{$order->status == 'received' ? 'selected' : ''}} value="received">
                                            Received
                                        </option>
                                        <option {{$order->status == 'completed' ? 'selected' : ''}} value="completed">
                                            Completed
                                        </option>
                                        <option {{$order->status == 'rejected' ? 'selected' : ''}} value="rejected">
                                            Rejected
                                        </option>
                                    </select>
                                    @include('backend.alerts.feedback', ['field' => 'status'])
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" type="submit">Change Order Status</button>
                            </div>

                        </div>
                    </form>
                    <div class="pull-right">
                        <h5 class="title">{{__("Order") }} {{ $order->status }}</h5>
                        {{-- <h5>Order {{ $order->status }}</h5> --}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Item Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($cartItem as $cartItem)
                                <tr>
                                    <td>{{ $cartItem->item->name }}</td>
                                    <td>{{ $cartItem->price}}</td>
                                    <td>{{ $cartItem->quantity }}</td>
                                    <td>{{ $cartItem->discount }}</td>
                                    <td>{{$cartItem->amount }}</td>
                                    <td>
                                        <form method="post" action="{{ route('backend.removeItem',$cartItem->id ) }}">
                                            @csrf
                                            @method('post')
                                            @if($order->status != 'completed')
                                            <button class="btn btn-danger" type="submit">Remove Item from
                                                Oreder</button>
                                            @else
                                            <button class="btn btn-danger" style="display:none" type="submit">Remove
                                                Item from Oreder</button>
                                            @endif
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <div class="pull-right">
                        <a href="{{ route('backend.orders.index') }}">
                            <button class="btn btn-dark" style="margin-right: 15px;">Back</button>
                        </a>
                    </div>
                    <h5 class="title">{{__(" Order Details")}}</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Total Amount {{ $order->total_amount }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <h5 class="title">{{__(" Customer Details")}}</h5>
                            <div class="description">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5> {{ $order->user->name }}</h5>
                                        <h5> {{ $order->user->contact_no }}</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5>{{ $order->delivery_address }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
</div>
@endsection

<style>
    .description {

        font-size: 1.5ch
    }
</style>
