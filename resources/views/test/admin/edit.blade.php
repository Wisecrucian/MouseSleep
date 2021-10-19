@extends('layouts.app')
@section('content')
	<div class="container">
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				{{$errors->first()}}
			</div>
		@endif
		@if(session('success'))
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				{{session()->get('success')}}
			</div>
		@endif
		<div class="col-md-12 bg-white row">	
			<form method="POST" action="{{route('test.admin.show.update',$item->id)}}" class="col-xs-6 w-75">
			@method('PATCH')
			@csrf
			<div class="card-body">
				<div class="container-fluid">
					<div class="form-group">
						<label for="theme">Заголовок</label>
						<input type="text" name="theme" value="{{$item->theme}}" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label for="message">Описание</label>
						<textarea name="message" class="form-control">	
						{{$item->message}}
						</textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>
				</div>		
			</div>
			</form>
			<div class="card-body col-xs-6">
				<div class="container-fluid">
					<div class="form-group">
						<label for="title">ID:</label>					
						<input type="text" name="id" value="{{$item->id}}" class="form-control" disabled />
					</div>
					<div class="form-group">
						<label for="created_at">Создано</label>
						<input type="text" name="created_at" value="{{$item->created_at}}" class="form-control" disabled />
					</div>
					<div class="form-group">
						<label for="updated_at">Изменено</label>
						<input type="text" name="updated_at" value="{{$item->updated_at}}" class="form-control" disabled />
					</div>
					<div class="form-group">
						<label for="deleted_at">Удалено</label>
						<input type="text" name="deleted_at" value="{{$item->deleted_at}}" class="form-control" disabled />
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection