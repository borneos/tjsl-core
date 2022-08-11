@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-note icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Edit Master Blog Category
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="{{ route('admin.blog-category.update',$category) }}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                     <label for="category">Category Name</label>
                     <input type="text" id="category" name="category" value="{{ $category->name }}" class="form-control">
                     @error('category')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="slug">Category Slug</label>
                     <input type="text" id="slug" name="slug" value="{{ $category->slug }}" class="form-control">
                     @error('slug')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
                  </div>
                  <div class="form-group">
                     <label for="image">Image</label><br>
                     <input type="file" accept="image/*" id="image" name="image">
                     @error('image')
                        <br><span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" src="{{ URL::to($category->image) }}" id="viewer" alt=""/>
                  </div>
                  <div class="text-right mt-2">
                     <a href="{{ route('admin.blog-category.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                     <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            readURL(this);
        });
         $('#category').keyup(function(e){
            $('#slug').val(convertToSlug(e.target.value));
         });
         function convertToSlug(Text) {
            return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
         }
    </script>
@endsection
