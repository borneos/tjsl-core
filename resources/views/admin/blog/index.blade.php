@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-notebook icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Blog<span class="badge badge-pill badge-primary">{{ number_format($blogs->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Blog</div></div>
         </div>
         <div class="page-title-actions">
             <a href="#" class="btn-shadow btn btn-info btn-lg">Add Blog</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
        <form method="GET">
          <div class="row mb-3">
            <div class="col-12 col-md-3">
              <div class="d-flex">
                <div class="form-inline w-100" >
                  <div class="input-group w-100">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-search fa-w-16"></i>
                      </div>
                    </div>
                    <input id="filter" name="filter" value="{{$filter}}" placeholder="Search" type="text" class="form-control" style="color: gray;" autocomplete="off">
                  </div>
                </div>
              </div>
            </div>   
            <div class="col-12 col-md-2">
              <div class="d-flex">
                  <div class="input-group w-100">
                    <select name="status" id="status" class="form-control">
                      <option {{ $status == 404 ? 'selected':'' }} disabled selected>Select Status</option>
                      <option {{ $status == 1 ? 'selected':'' }} value="1">Status Active</option>
                      <option {{ $status == 0 ? 'selected':'' }} value="0">Status Not Active</option>
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="d-flex">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-light btn-lg mr-2">Clear</a>
                <button type="submit" class="btn btn-primary btn-md">Search</button>
              </div>
            </div>
          </div>
        </form>
         <table style="width: 100%;" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                  <th>@sortablelink('id', 'ID')</th>
                  <th>Image</th>
                  <th>@sortablelink('title', 'Blog Title')</th>
                  <th>Blog Slug</th>
                  <th>Short Description</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Tags</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                         <td>
                            <img src="{{ URL::to($blog->compressImage('w_32,h_32')) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $blog->title ?? '-' }}</td>
                        <td>{{ $blog->slug ?? '-' }}</td>
                        <td title="{{ $blog->short_description }}">{{ $blog->short_description ? \Str::limit($blog->short_description, 60, ' .') : '-' }}</td>
                        <td title="{{ $blog->description }}">{{ $blog->description ? \Str::limit($blog->description, 60, ' .') : '-' }}</td>
                        <td>{{ $blog->category_id && $blog->category->name ? $blog->category->name : '-' }}</td>
                        <td>{{ $blog->author ?? '-' }}</td>
                        <td>{{ $blog->tags ?? '-' }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$blog->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.blog.status',[$blog['id'],$blog->status?0:1])}}'" id="statusCheckbox{{$blog->id}}" {{$blog->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="#" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @empty
                  <tr>
                    <td colspan="6">No blog to display.</td>
                  </tr>
                @endforelse
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $blogs->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$blogs->count()}} of {{ number_format($blogs->total(), 0, "", ".") }} blog</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection