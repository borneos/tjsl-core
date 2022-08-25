@extends('layouts.app-main')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>Master Merchant <span
                            class="badge badge-pill badge-primary">{{ number_format($merchants->total(), 0, '', '.') }}</span>
                        <div class="page-title-subheading">List Master Merchant</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.merchant.add') }}" class="btn-shadow btn btn-info btn-lg">Add Merchant</a>
                </div>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-5">
                        <div class="d-flex">
                            <form class="form-inline" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-search fa-w-16"></i>
                                        </div>
                                    </div>
                                    <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off"
                                        placeholder="Search Merchant" type="text" class="form-control"
                                        style="color: gray;">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary btn-md">Search</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-inline" method="GET">
                                <button class="btn btn-light btn-lg ml-2">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>@sortablelink('id', 'ID')</th>
                            <th>Image</th>
                            <th>@sortablelink('name', 'Merchant Name')</th>
                            <th>@sortablelink('slug', 'Merchant Slug')</th>
                            <th>@sortablelink('description', 'Description')</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($merchants as $merchant)
                            <tr>
                                <td>{{ $merchant->id }}</td>
                                <td><img src="{{ URL::to($merchant->image) }}" width="32" height="32" alt="">
                                </td>
                                <td>{{ $merchant->name ?? '-' }}</td>
                                <td>{{ $merchant->slug ?? '-' }}</td>
                                <td title="{{ $merchant->description }}">
                                    {{ $merchant->description ? \Str::limit($merchant->description, 60, ' .') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.merchant.edit', $merchant) }}" class="btn btn-warning btn-sm"
                                        title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                                    <button type="button" onclick="delete_merchant({{ $merchant->id }});loading();"
                                        class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px"
                                            class="pe-7s-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No merchant to display.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 flex-1">
                        {!! $merchants->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                    </div>
                    <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                        <p>Displaying {{ $merchants->count() }} of {{ number_format($merchants->total(), 0, '', '.') }}
                            merchant</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        function delete_merchant(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "DELETE",
                        url: "/merchant/" + id,
                        data: {
                            _token: _token,
                            id: id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                window.location = "{{ route('admin.merchant.index') }}";
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
