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
    <li class="breadcrumb-item active">Dashboard </li>
    </ol>
    </div>
    </div>
    </div>
    </div>


    <section class="content">
    <div class="container-fluid">

    <div class="row">
    <div class="col-lg-4 col-6">

    <div class="small-box bg-info">
    <div class="inner">
    <h3>150</h3>
    <p>User Registrations</p>
    </div>
    <div class="icon">
        <i class="ion ion-bag"></i>

    </div>
    <a href="{{route('admin.users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-4 col-6">

    <div class="small-box bg-success">
    <div class="inner">
    <h3>53<sup style="font-size: 20px">%</sup></h3>
    <p>Rooms</p>
    </div>
    <div class="icon ">
        <svg class="" xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
          </svg>

        </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-4 col-6">

    <div class="small-box bg-warning">
    <div class="inner">
    <h3>44</h3>
    <p>Devices</p>
    </div>
    <div class="icon">
    <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    {{-- <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
    <div class="inner">
    <h3>65</h3>
    <p>Unique Visitors</p>
    </div>
    <div class="icon">
    <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div> --}}

    </div>
    </div>
    </section>
</div>


@endsection
