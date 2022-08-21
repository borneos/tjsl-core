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
                    <div class="col-md-5">
                        <div class="form-group">
                           <label for="name">Product Name</label>
                           <input type="text" id="name" name="name" class="form-control">
                           @error('name')
                              <span class="text-danger mt-2">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                           <label for="price">Price</label>
                           <input type="number" id="price" name="price" class="form-control">
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
                            <input type="text" name="sku" id="sku" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
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
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image1">Image 1</label><br>
                           <input type="file" accept="image/*" id="image1" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer1" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image2">Image 2</label><br>
                           <input type="file" accept="image/*" id="image2" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer2" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image3">Image 3</label><br>
                           <input type="file" accept="image/*" id="image3" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer3" alt=""/>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image4">Image 4</label><br>
                           <input type="file" accept="image/*" id="image4" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer4" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image5">Image 5</label><br>
                           <input type="file" accept="image/*" id="image5" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer5" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="image6">Image 6</label><br>
                           <input type="file" accept="image/*" id="image6" name="image[]">
                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                           <img style="width: 50%;border: 0px solid; border-radius: 10px;" id="viewer6" alt=""/>
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
       let content = document.getElementById('description')
       CKEDITOR.replace(content, {
           language: 'en-gb'
       })
       CKEDITOR.config.allowedContent = true;

       function readURL(input) {
            if (input.data.files && input.data.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                  if(input.image == 1){
                     $('#viewer1').attr('src', e.target.result);
                  }else if(input.image == 2){
                     $('#viewer2').attr('src', e.target.result);
                  }else if(input.image == 3){
                     $('#viewer3').attr('src', e.target.result);
                  }else if(input.image == 4){
                     $('#viewer4').attr('src', e.target.result);
                  }else if(input.image == 5){
                     $('#viewer5').attr('src', e.target.result);
                  }else if(input.image == 6){
                     $('#viewer6').attr('src', e.target.result);
                  }
                }
                reader.readAsDataURL(input.data.files[0]);
            }
        }
        $("#image1").change(function () {
            readURL({image:1,data:this});
        });
        $("#image2").change(function () {
            readURL({image:2,data:this});
        });
        $("#image3").change(function () {
            readURL({image:3,data:this});
        });
        $("#image4").change(function () {
            readURL({image:4,data:this});
        });
        $("#image5").change(function () {
            readURL({image:5,data:this});
        });
        $("#image6").change(function () {
            readURL({image:6,data:this});
        });
        $("#tags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    </script>
@endsection
