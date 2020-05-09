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
                <div class="card-header">
                    <h4 class="card-title"> Shop List</h4>
                    <div class="pull-right">
                        <a href="{{ route('backend.shops.create') }}">
                            <button class="btn btn-primary">Create</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>ID</th>
                                <th>Name</>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($shops as $shop)
                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>{{ $shop->name }}</td>
                                    <td>{{ $shop->address }}</td>
                                    <td>{{ $shop->contact_no }}</td>
                                    <td>{{ $shop->created_at }}</td>
                                    <td>
                                        {{--<button class="btn btn-warning" onclick="changeStatus({{ $restaurant->id }})">Approve
                                        / Reject</button>--}}
                                        <a href="{{ route('backend.shops.edit',$shop->id) }}">
                                            <button class="btn btn-default">Edit</button>
                                        </a>
                                        <form method="post" action="{{ route('backend.shops.destroy',$shop->id) }}">
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
