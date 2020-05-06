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
                    <div class="card-header">
                        <h4 class="card-title"> Hand Work List</h4>
                        <div class="pull-right">
                            <a href="{{ route('backend.items.create') }}">
                                <button class="btn btn-primary">Create</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Created At</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img width="50px" src="{{ $item->image_url }}" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            {{--                                            <button class="btn btn-warning" onclick="changeStatus({{ $restaurant->id }})">Approve / Reject</button>--}}
                                            <a href="{{ route('backend.items.edit',$item->id) }}">
                                                <button class="btn btn-default">Edit</button>
                                            </a>
                                            <form method="post" action="{{ route('backend.items.destroy',$item->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">Delete</button>
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
