@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">



    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">New Type</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">New</li>
        <li class="breadcrumb-item "><a href="#">Types</a></li>
        <li class="breadcrumb-item "><a href="#">Dashboard</a></li>
    </ol>
</div>
</div>
</div>
</div>


<section class="content">

    <div class="container-fluit m-3">
        <form class="card card-secondary" action="{{route('admin.device.types.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <h3 class="card-title"></h3>
                </div>


                    <div class="card-body">
                    <div class="row d-flex ">
                        <div class="col-4">

                            <label >English Name</label>
                            <input type="text"  name="en_name" class="form-control" required>
                        </div>

                        <div class="col-4">

                            <label  >Arabic Name</label>
                            <input type="text" name="ar_name" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <label >Icon Code</label>
                            <input type="text" name="icon" class="form-control" required>
                        </div>

                    </div>

                    <div class="custom-control custom-switch mt-3">
                        <input type="checkbox" name="show_in_app" class="custom-control-input" id="customSwitch1" checked>
                        <label class="custom-control-label" for="customSwitch1">Show in App</label>
                    </div>

                        {{-- <span class="fa show-icon">&#x0F0EB;</span> --}}




                    </div>

                    <div class="card-footer ">
                        <div class="d-flex justify-content-between">
                        <button type='submit' class="btn btn-success">Save</button>
                        <button href="{{route('admin.device.types.index')}}" class="btn btn-danger">Cancel</button>
                        </div>

                        </div>


                    </form>


        </div>
    </section>
</div>
<script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

@endsection
