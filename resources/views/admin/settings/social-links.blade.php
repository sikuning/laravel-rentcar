@extends('admin.layout')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Social Links</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="active">Social links</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Content -->

<div class="content">
    <div class="animated fadeIn"> <!-- Animated -->
        <div class="row">
            <div class="offset-sm-1 col-xs-12 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Social Links</strong>
                    </div>
                    <div class="card-body card-block">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form class="form-horizontal" id="socialLinks" method="POST">
                            {{ csrf_field() }}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Show/Hide</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td><label class=" form-control-label">{{$row->name}}</label></td>
                                        <td>
                                            <input class="form-control" name="{{$row->name}}" value="{{$row->value}}" required>
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                @php $checked = ($row->status == '1') ? 'checked' : ''; @endphp
                                                <input type="checkbox" id="{{$row->name}}_status" name="{{$row->name}}_status" @php echo $checked  @endphp>
                                                <label for="{{$row->name}}_status"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--  / .row  -->
    </div> <!-- /.animated -->
</div>
<!-- /.content -->
<script src="{{asset('public/admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>

@stop