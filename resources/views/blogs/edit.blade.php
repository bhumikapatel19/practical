@extends('layouts.app')
@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header"><h1>Edit Blog</h1></div>

	                <div class="card-body" style="width:80%;">
	                	<?= Form::model($blogData,['method'=>'patch','route'=>['blog.update',$blogData->id],'files'=>true]) ?>
	                		<input type="hidden" name="id" value="">
	                		<input type="hidden" name="user_id" value="{{auth()->user()->id}}">
	                		<div class="form-group">
	                			<label>Title: </label>
	                			<?= Form::text('title',null,['class'=>'form-control', 'id'=>'title']) ?>
	                			<span class="title_error"></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Description: </label>
	                			<?= Form::textarea('description',null,['class'=>'form-control', 'id'=>'description','rows'=>3,'cols'=>5]) ?>
	                			<span class="description_error"></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Tags: </label>
	                			<?= Form::text('tags',null,['class'=>'form-control', 'id'=>'title','data-role'=>"tagsinput"]) ?>
	                			<span class="tags_error"></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Image: </label>
	                			<?= Form::file('image',null,['class'=>'form-control', 'id'=>'image']) ?>
	                			<img src="{{(IMAGE_PATH.'blogs/'.$blogData->image)}}" height="100px" width="100px">
	                			<span class="image_error"></span>
	                		</div>
	                		<button class="btn btn-primary" type="submit">Submit</button>
	                		<a href="{{route('blog.index')}}" class="btn btn-default">Cancel</a>
	                	<?= Form::close() ?>
                	</div>
                </div>
            </div>
        </div>
    </div>
@stop