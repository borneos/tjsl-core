@extends('layouts.app-main')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-notebook icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>
                        Add Master Blog
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                                @error('title')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug">
                                @error('slug')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="js-data-example-ajax multiselect-dropdown form-control">
                                    <option disabled selected>Choose One!</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" name="author" id="author">
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" name="tags" id="tags">
                            </div>
                            <label for="image">Image</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" accept="image/*" onchange="previewImageOnAdd()" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                                </div>
                            </div>
                            <div class="form-group text-center my-2">
                                <img id="imgpreview" class="img-thumbnail" alt=""/>
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.blog.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImageOnAdd() {
            imgpreview.src=URL.createObjectURL(event.target.files[0])
        }
        $('#title').keyup(function(e){
            $('#slug').val(convertToSlug(e.target.value));
         });
         function convertToSlug(Text) {
            return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
         }
    </script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        let content = document.getElementById('editor')
        CKEDITOR.replace(content, {
            language: 'en-gb'
        })
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection
