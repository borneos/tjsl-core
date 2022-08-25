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
               Add Master Product
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
               <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="merchant">Merchant</label>
                           <select name="merchant" id="merchant" class="js-data-example-ajax multiselect-dropdown form-control">
                              <option disabled selected>Choose Merchant</option>
                              @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                              @endforeach
                           </select>
                           @error('merchant')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="name">Product Name</label>
                           <input type="text" id="name" name="name" class="form-control">
                           @error('name')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="slug">Slug</label>
                           <input type="text" id="slug" name="slug" class="form-control" readonly>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>SKU Product</label>
                            <input type="text" name="sku" id="sku" class="form-control">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="price">Price</label>
                           <input type="number" id="price" name="price" class="form-control">
                           @error('price')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="tags">Tags</label>
                           <select class="form-control" id="tags" name="tags[]" multiple="multiple"></select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label><br>
                            <label class="m-auto align-middle" for="statusCheckbox">
                              <input type="checkbox" data-toggle="toggle" data-size="small" name="status" id="statusCheckbox">
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
            for(var i=0; i < $('#image').get(0).files.length; i++){
               $('#imgpreview').append("<img class='img-thumbnail' style='object-fit: cover' height='250' width='250' src='"+URL.createObjectURL(event.target.files[i])+"' alt=''/>");
            }
      }
      $("#tags").select2({
         tags: true,
         tokenSeparators: [',', ' ']
      });
       document.getElementById("name").addEventListener("input", function () {
            document.getElementById("slug").value = string_to_slug(this.value);
        });
        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, ""); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
            }

            str = str
                .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
                .replace(/\s+/g, "-") // collapse whitespace and replace by -
                .replace(/-+/g, "-"); // collapse dashes
            str = str+`-`+makeid(10);
            return str;
        }
        function makeid(length) {
          var result           = '';
          var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          return result;
        }
    </script>
@endsection
