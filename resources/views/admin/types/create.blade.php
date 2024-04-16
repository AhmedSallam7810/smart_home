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
        <div class="card card-secondary">

            <div class="card-header">
                <h3 class="card-title"></h3>
                </div>


                    <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">

                            <label >English Name</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>

                        <div class="col-6">

                            <label >Arabic Name</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>

                    </div>


                        <img id="preview"  alt="Selected Image" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/sheep-3.jpg"
                         class="img-fluid img-thumbnail  m-5" style="width: 20%;height:20%"  alt="Sheep">

                        <div class="custom-file col-6 mx-5">
                            <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*" onchange="previewImage(event)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>





                    </div>

                    <div class="card-footer ">
                        <div class="d-flex justify-content-between">
                        <button href="#" class="btn btn-success">Save</button>
                        <button href="#" class="btn btn-danger">Cancel</button>
                        </div>

                        </div>


                    </div>


        </div>
    </section>
</div>
<script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('preview');
        output.style.display="inline";
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

@endsection
