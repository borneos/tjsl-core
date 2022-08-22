@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Product <span class="badge badge-pill badge-primary">{{ number_format($products->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Product</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.product.add') }}" class="btn-shadow btn btn-info btn-lg">Add Product</a>
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
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search Product" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('sku', 'SKU Product')</th>
                  <th>@sortablelink('merchant_name', 'Merchant Name')</th>
                  <th>@sortablelink('name', 'Product Name')</th>
                  <th>@sortablelink('description','Description')</th>
                  <th>@sortablelink('tags','Tags')</th>
                  <th>@sortablelink('price','Price')</th>
                  <th>Status</th>
                  <th style="min-width: 100px">Action</th>
               </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ URL::to($product->compressImage('w_32,h_32')) }}" width="32" height="32" alt=""></td>
                        <td>{{ $product->sku ?? '-' }}</td>
                        <td>{{ $product->merchant_name ?? '-' }}</td>
                        <td>{{ $product->name ?? '-' }}</td>
                        <td title="{{  $product->description  }}">{!! $product->description ? \Str::limit($product->description, 60, ' .') : '-' !!}</td>
                        <td title="{{ $product->tags }}">{{ $product->tags ? \Str::limit($product->tags, 60, ' .') : '-' }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$product->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.product.status',[$product['id'],$product->status?0:1])}}'" id="statusCheckbox{{$product->id}}" {{$product->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_product({{$product->id}})" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @empty
                  <tr>
                    <td colspan="6">No product to display.</td>
                  </tr>
                @endforelse
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $products->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$products->count()}} of {{ number_format($products->total(), 0, "", ".") }} product</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
@section('js')
   <script type="text/javascript">
      function delete_product(id)
      {
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
                    url: "/product/"+id,
                    data: {_token:_token,id:id},
                    success:function(response){
                      if(response.status == 200){
                          Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                          window.location = "{{ route('admin.product.index') }}";
                      }
                    }
                });
              }
            })
      }
   </script>
@endsection