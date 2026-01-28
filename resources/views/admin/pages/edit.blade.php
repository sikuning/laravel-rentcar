 @extends('admin.layout')

 @section('content')

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Pages</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('/admin/pages')}}">Pages</a></li>
                                    <li class="active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit Page</strong> 
                            </div>
                            <div class="card-body card-block">
                            @if(isset($pages))
                                <form class="row" id="update_page"  method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <div class="form-group col-md-12">
                                        <label class=" form-control-label">Title:</label>
                                        <input class="form-control" name="title" value="{{$pages->title}}" required/>
                                        <input type="hidden" name="id" value="{{$pages->id}}"/>
                                    </div> 
                                    <div class="form-group col-md-12">
                                        <label class=" form-control-label">Page Slug:</label>
                                        <input class="form-control" name="slug" value="{{$pages->slug}}"/>
                                    </div> 
                                    <div class="form-group col-md-12">
                                        <label class=" form-control-label"> Description:</label>
                                        <textarea name="desc" id="summernote" class="form-control">{!!$pages->desc!!}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class=" form-control-label"> Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @php echo ($pages->status == '1') ? 'selected' : '';  @endphp >Show</option>
                                            <option value="0" @php echo ($pages->status == '0') ? 'selected' : '';  @endphp >Hide</option>
                                        </select>
                                    </div>
                                    <div class="form-actions form-group col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md">Update</button>
                                    </div>
                                </form>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->


@stop