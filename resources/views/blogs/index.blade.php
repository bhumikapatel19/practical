@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Blog listing</h1></div>

                <div class="card-body">
                    <a class="btn btn-primary pull-right mb-2" href="{{route('blog.create')}}">Add Blog</a>
                   <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>tags</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blog_data as $blog_key=>$blog_value)
                        <tr>
                            <td>{{$blog_key+1}}</td>
                            <td>{{ $blog_value['title'] }}</td>
                            <td>{{ Str::limit($blog_value['description'],100) }}</td>
                            <td>{{ $blog_value['tags'] }}</td>
                            <td><img src="{{(IMAGE_PATH.'blogs/'.$blog_value['image'])}}" height="100px" width="100px"></td>
                            <td>
                                @if(auth()->user() && $blog_value['user_id'] == auth()->user()->id)
                                    <a href="{{route('blog.edit',$blog_value['id'])}}">Edit</a>&nbsp; 
                                    <button type="button" onclick="deleteBlog({{$blog_value['id']}})">Delete</button>
                                @else
                                    N/A
                                @endif
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
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    function deleteBlog(id){
        var url = "{{ route('blog.destroy',[':blog']) }}";
        url = url.replace(":blog",id);
        
        $.ajax({
            url: url,
            method: "DELETE",
            data:{token:"{{csrf_token()}}"},
            complete:function(res){

            },
            success: function(res){
                window.location.reload();
            },
            error:function(err){
                console.log(err);
            }
        })
    }
</script>
@stop