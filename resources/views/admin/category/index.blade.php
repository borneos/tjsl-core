@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Category <span class="badge badge-pill badge-primary">{{ number_format($categories->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Category</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Category</a>
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
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search Category" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('name', 'Category Name')</th>
                  <th>@sortablelink('slug', 'Category Slug')</th>
                  <th>@sortablelink('description','Description')</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><img src="{{ URL::to($category->image) }}" width="32" height="32" alt=""></td>
                        <td>{{ $category->name ?? '-' }}</td>
                        <td>{{ $category->slug ?? '-' }}</td>
                        <td title="{{ $category->description }}">{{ $category->description ? \Str::limit($category->description, 60, ' .') : '-' }}</td>
                        <td>
                           <a href="{{ route('admin.category.edit',$category) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @empty
                  <tr>
                    <td colspan="6">No category to display.</td>
                  </tr>
                @endforelse
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $categories->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$categories->count()}} of {{ number_format($categories->total(), 0, "", ".") }} category</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection