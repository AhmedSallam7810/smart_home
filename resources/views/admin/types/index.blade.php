@extends('admin.layouts.master')
@section('content')

<div class="content-wrapper">

    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Types</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Types</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>
</div>
</div>
</div>

{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

<section class="content">
        <div class="text-right mb-3"><a class="btn btn-secondary px-4 " href="{{route('admin.types.create')}}">
             <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg>
          New
        </a></div>
    <div class="container-fluit">
        <div class="card card-secondary">

            <div class="card-header">
                <h3 class="card-title"></h3>
                </div>

        <table class="table table-bordered mb-0  ">
            <thead>
              <tr>
                <th class="col-1">#</th>
                <th class="col-2">Image</th>
                <th class="col-2">English Name</th>
                <th class="col-2">Arabic Name</th>
                <th class="col-2">Show in App</th>
                <th class="col-3 text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($types as $type )

                <tr>
                    <th style="vertical-align: middle;">{{$loop->index+1}}</th>
                    <td style="vertical-align: middle;" class="w-10">
                        <img src="{{url($type->image_path)}}" class="img-fluid img-thumbnail" alt="Sheep">
                    </td >
                    <td style="vertical-align: middle;">{{$type->en_name}}</td>
                    <td style="vertical-align: middle;">{{$type->ar_name}}</td>
                    <td style="vertical-align: middle; text-align: center;">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input switch-show-in-app" id="customSwitch{{$type->id}}" data-id="{{$type->id}}" {{$type->show_in_app?'checked':''}}>
                            <label class="custom-control-label" for="customSwitch{{$type->id}}"></label>
                        </div>
                    </td>
                    <td style="vertical-align: middle; text-align: center;" class="project-actions ">
                    {{-- <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-folder">
                    </i>
                    View
                    </a> --}}
                    <a class="btn btn-info btn-sm " href="{{route('admin.types.edit',$type->id)}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal{{$type->id}}">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                    </a>
                    </td>
                  </tr>
                  <div class="modal fade" id="deleteModal{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                      <form  action="{{route('admin.types.destroy',$type->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-header">
                          <h5 class="modal-title text-danger" id="exampleModalLabel">Warning</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body my-3">
                          are you sure from deleting <b>{{$type->en_name}}</b> type ?
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                      </form>
                        </div>
                    </div>
                  </div>
                @endforeach

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
    $(document).ready(function() {
      $('.switch-show-in-app').click(function() {
        if ($(this).is(':checked')) {
            console.log('okk');
            console.log($(this).data('id'));
            var type_id=$(this).data('id');
            var url = '{{ route("admin.types.destroy", ":parameter") }}';
            url = url.replace(':parameter', type_id);
        $.delete(url, { show_in_app: 1 });
        } else {
            console.log('noo');
            console.log($(this).data('id'));

        //   $.post('', { status: 'off' });
        }
      });
    });
    </script> --}}

<script>
    $(document).ready(function() {
        $('.switch-show-in-app').click(function() {
            var checked = $(this).prop('checked');
            var type_id=$(this).data('id');
            var route_url = '{{ route("admin.types.update", ":parameter") }}';
            route_url = route_url.replace(':parameter', type_id);

            $.ajax({
                url: route_url,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}', // Include CSRF token for Laravel
                    '_method':'put',
                    // 'show_in_app': 0,

                },
                success: function(response) {
                    // Handle the success response
                },
                error: function(xhr) {
                    // Handle the error response
                }
            });
        });
    });
</script>


@endsection
