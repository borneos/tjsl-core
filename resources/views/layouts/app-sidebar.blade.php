<div class="scrollbar-sidebar" style="overflow: scroll;">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li>
              <a href="/dashboard" class="dashboard {{ count(request()->segments()) == 1 && request()->segments()[0] == 'dashboard' ? 'mm-active' : '' }}"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards</a>
            </li>
            <li class="app-sidebar__heading">Master Data</li>
        </ul>
        <ul class="vertical-nav-menu">
          <li>
              <a class="banner {{ count(request()->segments()) == 1 && request()->segments()[0] == 'banner' ? 'mm-active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="metismenu-icon pe-7s-photo-gallery"></i>Banner</a>
          </li>
          <li>
              <a class="category {{ count(request()->segments()) == 1 && request()->segments()[0] == 'category' ? 'mm-active' : '' }}" href="{{ route('admin.category.index') }}"><i class="metismenu-icon pe-7s-server"></i>Category</a>
          </li>
          <li>
              <a class="merchant {{ count(request()->segments()) == 1 && request()->segments()[0] == 'merchant' ? 'mm-active' : '' }}" href="{{ route('admin.merchant.index') }}"><i class="metismenu-icon pe-7s-home"></i>Merchant</a>
          </li>
          <li>
              <a class="product {{ count(request()->segments()) == 1 && request()->segments()[0] == 'product' ? 'mm-active' : '' }}" href="{{ route('admin.product.index') }}"><i class="metismenu-icon pe-7s-server"></i>Product</a>
          </li>
          <li class="app-sidebar__heading">Blog</li>
        </ul>
         <ul class="vertical-nav-menu">
          <li>
              <a class="blog {{ count(request()->segments()) == 1 && request()->segments()[0] == 'blog' ? 'mm-active' : '' }}" href="{{ route('admin.blog.index') }}"><i class="metismenu-icon pe-7s-notebook"></i>Blog</a>
          </li>
          <li>
              <a class="blog-category {{ count(request()->segments()) == 1 && request()->segments()[0] == 'blog-category' ? 'mm-active' : '' }}" href="{{ route('admin.blog-category.index') }}"><i class="metismenu-icon pe-7s-note"></i>Blog Category</a>
          </li>
        </ul>
    </div>
</div>
