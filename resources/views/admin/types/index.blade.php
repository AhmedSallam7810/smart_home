@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">

    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
    </div>
    </div>
    </div>
    </div>


    <section class="content">
    <div class="container-fluid">
        <div class="card card-secondary">

            <div class="card-header">
                <h3 class="card-title">Types</h3>
                </div>

        <table class="table table-bordered ">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">English Name</th>
                <th scope="col">Arabic Name</th>
                <th>Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th >1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td class="project-actions text-right">
                  <a class="btn btn-primary btn-sm" href="#">
                  <i class="fas fa-folder">
                  </i>
                  View
                  </a>
                  <a class="btn btn-info btn-sm" href="#">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
                  </a>
                  <a class="btn btn-danger btn-sm" href="#">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                  </a>
                  </td>
                </tr>
              <tr>
                <th >2</th>
                <td>Jaco</td>
                <td>Tho</td>
                <td>@fat</td>
              </tr>
              {{-- <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr> --}}
            </tbody>
          </table>
        </div>
        </div>
    </section>
</div>

@endsection
