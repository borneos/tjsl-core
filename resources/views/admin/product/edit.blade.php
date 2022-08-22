@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Edit Master Product
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <form action="{{ route('admin.product.update',$product) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                  @method('PUT')
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="merchant">Merchant</label>
                           <select name="merchant" id="merchant" class="js-data-example-ajax multiselect-dropdown form-control">
                              @foreach ($merchants as $merchant)
                                    <option {{ $product->merchant_id == $merchant->id ?'selected':'' }} value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                              @endforeach
                           </select>
                           @error('merchant')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                           <label for="name">Product Name</label>
                           <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-control">
                           @error('name')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                           <label for="price">Price</label>
                           <input type="number" id="price" name="price" value="{{ $product->price }}" class="form-control">
                           @error('price')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU Product</label>
                            <input type="text" name="sku" id="sku" value="{{ $product->sku }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                           <label for="tags">Tags</label>
                           <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                            @if($tags)
                            @foreach ($tags as $tag)    
                                <option {{ $tag ?'selected':'' }}>{{ $tag }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control">{!! $product->description !!}</textarea>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label><br>
                            <label class="m-auto align-middle" for="statusCheckbox">
                              <input type="checkbox" data-toggle="toggle" data-size="small" name="status" id="statusCheckbox" {{ $product->status == 1 ?'checked':'' }}>
                           </label>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="image">Image</label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">Upload Image</span>
                              </div>
                              <div class="custom-file">
                                 <input type="file" accept="image/*" onchange="previewImage()" class="custom-file-input" id="image" name="image[]" multiple>
                                 <label class="custom-file-label">Choose File</label>
                              </div>
                           </div>
                           @if($additional_image)
                            <div class="form-group text-center my-2" id="old-img-preview">
                                @foreach($additional_image as $image)
                                    <img class='img-thumbnail' style='object-fit: cover' height='250' width='250' src='{{ $image->https }}' alt=''/>
                                @endforeach
                            </div>
                            @endif
                           <div class="form-group text-center my-2" id="imgpreview">
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="text-right mt-2">
                     <a href="{{ route('admin.product.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                     <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
      let content = document.getElementById('description');
      CKEDITOR.replace(content, {
         language: 'en-gb'
      })
      CKEDITOR.config.allowedContent = true;
      function previewImage() {
            $('#image').get(0).files.length > 0 ? $('#old-img-preview').hide() : '';
            for(var i=0; i < $('#image').get(0).files.length; i++){
               $('#imgpreview').append("<img class='img-thumbnail' style='object-fit: cover' height='250' width='250' src='"+URL.createObjectURL(event.target.files[i])+"' alt=''/>");
            }
      }
      $("#tags").select2({
         tags: true,
         tokenSeparators: [',', ' ']
      });
    </script>
@endsection
