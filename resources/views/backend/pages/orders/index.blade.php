b
@extends('backend.layouts.app', [
    'namePage' => 'Orders',
    'class' => 'sidebar-mini',
    'activePage' => 'orders',
    'activeNav' => '',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Order List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Purchase Time</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->delivery_address}}</td>
                                    <td>{{ $order->user->contact_no }}</td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('backend.orders.show',$order->id) }}">
                                            <button class="btn btn-default">view</button>
                                        </a>
                                        <form method="post"
                                            action="{{ route('backend.changeOrderStatus',$order->id) }}">
                                            @csrf
                                            @method('post')
                                            @if($order->status == 'pending')
                                            <button class="btn btn-danger" type="submit">Change Status To
                                                Received</button>
                                            @else
                                            <button class="btn btn-danger" style="display: none" type="submit">Change
                                                Status To Received</button>
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
    </div>
</div>
@endsection
