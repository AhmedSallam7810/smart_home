 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="{{url('dist/img/CT png.png')}}" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
      <span class="brand-text font-weight-light">admin</span>
    </a> --}}
    <a href="index3.html" class="brand-link d-flex justify-content-center">
        <span class="brand-text font-weight-light">Con<b>Tech</b></span>
        </a>


    <!-- Sidebar -->
    <div class="sidebar">


<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
    <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
    <a href="#" class="d-block">Admin User</a>
    </div>
    </div>

    <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
    <div class="input-group-append">
    <button class="btn btn-sidebar">
    <i class="fas fa-search fa-fw"></i>
    </button>
    </div>
    </div>
    </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li  @class([
                "nav-item",
                Request::routeIs(['admin'])?'bg-primary':'',
            ])>
                <a href="{{url('admin')}}" class="nav-link">
                    <svg class="nav-icon " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                      </svg>

                <p>
                Home
                </p>
                </a>
                </li>

                <li  @class([
                    "nav-item",
                    Request::routeIs(['admin.users*'])?'bg-primary':'',
                ])>
                    <a href="{{url('admin/users')}}" class="nav-link">
                        <svg class="nav-icon " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                            </svg>
                                                <p>
                    users
                    </p>
                    </a>
                    </li>

                    <li  @class([
                        "nav-item",
                        Request::routeIs(['admin.types*'])?'bg-primary':'',
                    ])>
                        <a href="{{url('admin/types')}}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square nav-icon" viewBox="0 0 16 16">
                                <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                              </svg>
                                                  <p>
                        room types
                        </p>
                        </a>
                        </li>

                        <li  @class([
                            "nav-item",
                            Request::routeIs(['admin.device*'])?'bg-primary':'',
                        ])>
                            <a href="{{route('admin.device.types.index')}}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle nav-icon" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                  </svg>
                                                      <p>
                                                        device types
                                                    </p>
                            </a>
                            </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
