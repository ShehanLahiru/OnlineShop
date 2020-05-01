@if (session('success'))
    <div class="col-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Success!</strong>
           <h5> {{ session('success') }}</h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="col-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> Error!</strong>
           <h5> {{ session('error') }}</h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif
