@extends('admin.layouts.master')

@section('content')

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Room Types</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Room Types</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title"></h3>
                </div> --}}

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>

                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Progress</th>
                                <th >Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type )

                            <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

            <div class="card-footer clearfix">
                {{-- <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul> --}}
            </div>
        </div>
    </div>
</section>

@endsection
