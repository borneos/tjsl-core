@extends('layouts.app-main')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Add Master Merchant
               <div class="page-title-subheading">

               </div>
            </div>
         </div>
      </div>
   </div>

   <form action="{{ route('admin.merchant.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            {{-- <div class="card-header">Merchant Information</div> --}}
            <div class="card-body">
                  <div class="form-group">
                     <label for="category">Category Name</label>
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
                     <label for="type">Type</label>
                     <input type="text" id="type" name="type" class="form-control">
                     @error('type')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="image">Image</label><br>
                     <input type="file" accept="image/*" id="image" name="image">
                     @error('image')
                        <br><span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer" alt=""/>
                  </div>
                  <div class="form-group">
                     <label for="seo_image">Seo Image</label><br>
                     <input type="file" accept="image/*" id="seo_image" name="seo_image">
                     @error('seo_image')
                        <br><span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group text-center" style="margin-bottom:0%;">
                     <img style="width: 25%;border: 0px solid; border-radius: 10px;" id="viewer_seo" alt=""/>
                  </div>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" class="form-control">
                     @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="slug">Slug</label>
                     <input type="text" id="slug" name="slug" class="form-control">
                     @error('slug')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="tagline">Tagline</label>
                     <input type="text" id="tagline" name="tagline" class="form-control">
                     @error('tagline')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="short_description">Short Description</label>
                     <textarea name="short_description" id="short_description" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="biography">Biography</label>
                     <textarea name="biography" id="biography" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="telp">Telepon</label>
                     <input type="text" id="telp" name="telp" class="form-control">
                     @error('telp')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="address">Address</label>
                     <textarea name="address" id="address" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <label for="city">City</label>
                     <input type="text" id="city" name="city" class="form-control">
                     @error('city')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="district">District</label>
                     <input type="text" id="district" name="district" class="form-control">
                     @error('district')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="lat">Latitude</label>
                     <input type="text" id="lat" name="lat" class="form-control">
                     @error('lat')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="long">Longitude</label>
                     <input type="text" id="long" name="long" class="form-control">
                     @error('long')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                  </div>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="main-card mb-3 card">
            {{-- <div class="card-header">Owner Information</div> --}}
            <div class="card-body">
                <div class="form-group">
                     <label for="owner_name">Owner Name</label>
                     <input type="text" id="owner_name" name="owner_name" class="form-control">
                     @error('owner_name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="owner_telp">Owner Telepon</label>
                     <input type="text" id="owner_telp" name="owner_telp" class="form-control">
                     @error('owner_telp')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="owner_email">Owner Email</label>
                     <input type="email" id="owner_email" name="owner_email" class="form-control">
                     @error('owner_email')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="owner_address">Owner Address</label>
                     <textarea name="owner_address" id="owner_address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                     <label for="soc_fb">Facebook</label>
                     <input type="text" id="soc_fb" name="soc_fb" class="form-control">
                     @error('soc_fb')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="soc_ig">Instagram</label>
                     <input type="text" id="soc_ig" name="soc_ig" class="form-control">
                     @error('soc_ig')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="soc_twitter">Twitter</label>
                     <input type="text" id="soc_twitter" name="soc_twitter" class="form-control">
                     @error('soc_twitter')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="website">Link Website</label>
                     <input type="text" id="website" name="website" class="form-control">
                     @error('website')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="link_borneos">Link Borneos</label>
                     <input type="text" id="link_borneos" name="link_borneos" class="form-control">
                     @error('link_borneos')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="link_tokopedia">Link Tokopedia</label>
                     <input type="text" id="link_tokopedia" name="link_tokopedia" class="form-control">
                     @error('link_tokopedia')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="link_shopee">Link Shopee</label>
                     <input type="text" id="link_shopee" name="link_shopee" class="form-control">
                     @error('link_shopee')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="form-group">
                     <label for="link_bukalapak">Link Bukalapak</label>
                     <input type="text" id="link_bukalapak" name="link_bukalapak" class="form-control">
                     @error('link_bukalapak')
                        <span class="text-danger mt-2">{{ $message }}</span>
                     @enderror
                </div>
                <div class="text-right mt-2">
                    <a href="{{ route('admin.merchant.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                    <button type="submit" class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i class="pe-7s-diskette btn-icon-wrapper"></i>Save</button>
                </div>
            </div>
         </div>
      </div>
    </div>
    </form>
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
        function readURL_seo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer_seo').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function () {
            readURL(this);
        });
        $("#seo_image").change(function () {
            readURL_seo(this);
        });
         $('#name').keyup(function(e){
            $('#slug').val(convertToSlug(e.target.value));
         });
         function convertToSlug(Text) {
            return Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
         }
    </script>
@endsection
