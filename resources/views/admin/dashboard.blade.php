@extends('layouts.app-main')

@section('content')
<div class="app-main__inner p-0">
  <div class="app-inner-layout chat-layout">
    <div class="app-inner-layout__header text-white bg-premium-dark">
      <div class="app-page-title">
        <div class="page-title-wrapper">
          <div class="page-title-heading">
            <div class="page-title-icon"><i class="pe-7s-rocket icon-gradient bg-sunny-morning"></i></div>
            <div>Dashboard<div class="page-title-subheading">Dashboard Admin</div></div>
          </div>
          <div class="page-title-actions">
            <button type="button" data-toggle="tooltip" title="" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark" data-original-title="Example Tooltip"><i class="fa fa-star"></i></button>
            <div class="d-inline-block dropdown">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span> Buttons
              </button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                <ul class="nav flex-column">
                  <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon lnr-inbox"></i><span> Inbox </span>
                      <div class="ml-auto badge badge-pill badge-secondary">86</div>
                    </a></li>
                  <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon lnr-book"></i><span> Book </span>
                      <div class="ml-auto badge badge-pill badge-danger">5</div>
                    </a></li>
                  <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon lnr-picture"></i><span> Picture </span></a></li>
                  <li class="nav-item"><a disabled="" href="javascript:void(0);" class="nav-link disabled"><i class="nav-link-icon lnr-file-empty"></i><span> File Disabled </span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-4 mt-4 main-card mb-3 card">
      <div class="no-gutters row">
        <div class="col-md-3 col-xl-3">
          <div class="widget-content">
            <div class="widget-content-wrapper">
              <div class="widget-content-right ml-0 mr-3">
                <div class="widget-numbers text-primary">{{ DB::table('merchants')->count() }}</div>
              </div>
              <div class="widget-content-left">
                <div class="widget-heading">Merchants</div>
                <div class="widget-subheading">Total Merchants</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-xl-3">
          <div class="widget-content">
            <div class="widget-content-wrapper">
              <div class="widget-content-right ml-0 mr-3">
                <div class="widget-numbers text-info">{{ DB::table('products')->count() }}</div>
              </div>
              <div class="widget-content-left">
                <div class="widget-heading">Products</div>
                <div class="widget-subheading">Total Products</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-xl-3">
          <div class="widget-content">
            <div class="widget-content-wrapper">
              <div class="widget-content-right ml-0 mr-3">
                <div class="widget-numbers text-dark">{{ DB::table('categories')->count() }}</div>
              </div>
              <div class="widget-content-left">
                <div class="widget-heading">Categories</div>
                <div class="widget-subheading">Total Categories</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-xl-3">
          <div class="widget-content">
            <div class="widget-content-wrapper">
              <div class="widget-content-right ml-0 mr-3">
                <div class="widget-numbers text-dark">{{ DB::table('blog')->count() }}</div>
              </div>
              <div class="widget-content-left">
                <div class="widget-heading">Blogs</div>
                <div class="widget-subheading">Total Blogs</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="mx-4 mt-4">
      <div class="tabs-animation">
        <div class="row">
          <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title">Income Report</h5>
                <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                  <div style="height: 227px;"><canvas id="line-chart"></canvas></div>
                </div>
                <h5 class="card-title">Target Sales</h5>
                <div class="mt-3 row">
                  <div class="col-sm-12 col-md-4">
                    <div class="widget-content p-0">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left">
                            <div class="widget-numbers text-dark">65%</div>
                          </div>
                        </div>
                        <div class="widget-progress-wrapper mt-1">
                          <div class="progress-bar-xs progress-bar-animated-alt progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"></div>
                          </div>
                          <div class="progress-sub-label">
                            <div class="sub-label-left font-size-md">Sales</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                    <div class="widget-content p-0">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left">
                            <div class="widget-numbers text-dark">22%</div>
                          </div>
                        </div>
                        <div class="widget-progress-wrapper mt-1">
                          <div class="progress-bar-xs progress-bar-animated-alt progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;"></div>
                          </div>
                          <div class="progress-sub-label">
                            <div class="sub-label-left font-size-md">Profiles</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                    <div class="widget-content p-0">
                      <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left">
                            <div class="widget-numbers text-dark">83%</div>
                          </div>
                        </div>
                        <div class="widget-progress-wrapper mt-1">
                          <div class="progress-bar-xs progress-bar-animated-alt progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width: 83%;"></div>
                          </div>
                          <div class="progress-sub-label">
                            <div class="sub-label-left font-size-md">Tickets</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
              <div class="grid-menu grid-menu-2col">
                <div class="no-gutters row">
                  <div class="col-sm-6">
                    <div class="widget-chart widget-chart-hover">
                      <div class="icon-wrapper rounded-circle">
                        <div class="icon-wrapper-bg bg-primary"></div><i class="lnr-home text-primary"></i>
                      </div>
                      <div class="widget-numbers">{{ DB::table('merchants')->count() }}</div>
                      <div class="widget-subheading">Total Merchant</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="widget-chart widget-chart-hover">
                      <div class="icon-wrapper rounded-circle">
                        <div class="icon-wrapper-bg bg-primary"></div><i class="lnr-database text-info"></i>
                      </div>
                      <div class="widget-numbers">{{ DB::table('products')->count() }}</div>
                      <div class="widget-subheading">Total Product</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
