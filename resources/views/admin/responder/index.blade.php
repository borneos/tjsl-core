@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-next-2 icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Responder <span class="badge badge-pill badge-primary">{{ number_format($responders->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Responder</div></div>
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
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search Responder" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('name', 'Responder Name')</th>
                  <th>@sortablelink('email', 'Email')</th>
                  <th>@sortablelink('telp','Telp')</th>
                  <th>@sortablelink('message','Message')</th>
               </tr>
            </thead>
            <tbody>
                @forelse ($responders as $responder)
                    <tr>
                        <td>{{ $responder->id }}</td>
                        <td>{{ $responder->name ?? '-' }}</td>
                        <td>{{ $responder->email ?? '-' }}</td>
                        <td>{{ $responder->telp ?? '-' }}</td>
                        <td title="{{ $responder->message }}">{{ $responder->message ? \Str::limit($responder->message, 75, ' .') : '-' }}</td>
                    </tr>
                @empty
                  <tr>
                    <td colspan="5">No responder to display.</td>
                  </tr>
                @endforelse
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $responders->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$responders->count()}} of {{ number_format($responders->total(), 0, "", ".") }} responder</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection