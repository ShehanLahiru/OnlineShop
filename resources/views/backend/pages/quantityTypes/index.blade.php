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
                    <div class="card-header">
                        <h4 class="card-title"> Quantity Types List</h4>
                        <div class="pull-right">
                            <a href="{{ route('backend.quantityTypes.create') }}">
                                <button class="btn btn-primary">Create</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Name</>
                                <th>Unit1</>
                                <th>Unit2</>
                                <th>Created At</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($quantityTypes as $quantityType)
                                    <tr>
                                        <td>{{ $quantityType->name }}</td>
                                        <td>{{ $quantityType->unit1 }}</td>
                                        <td>{{ $quantityType->unit2 }}</td>
                                        <td>{{ $quantityType->created_at }}</td>
                                        <td>

                                            <a href="{{ route('backend.quantityTypes.edit',$quantityType->id) }}">
                                                <button class="btn btn-default">Edit</button>
                                            </a>
                                            <form method="post" action="{{ route('backend.quantityTypes.destroy',$quantityType->id) }}">
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
        {{ $quantityTypes->links() }}
    </div>
@endsection
