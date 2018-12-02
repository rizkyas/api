@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Categories</a> </div>
    <h1>Categories</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif   
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif 
  </div>
  <div class="container-fluid">
    <hr>
    <a href="{{ url('/admin/add-category') }}" class="btn btn-success">Add</a>
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon">
            <i class="icon-th"></i>
          </span>
          <h5>View Categories</h5>
        </div>
        <div class="widget-content nopadding">
              <table class="table table-bordered data-table dataTable" >
                <thead>
                  <tr role="row">
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category URL</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr class="gradeX">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->url }}</td>
                    <td>{{ $category->description }}</td>
                    <td class="center">
                        <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini">Update</a> 
                        <a id="delCat" href="{{ url('/admin/delete-category/'.$category->id) }}" class="btn btn-danger btn-mini">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection