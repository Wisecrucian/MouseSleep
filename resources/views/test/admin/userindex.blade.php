@extends('layouts.app')


@section('username') 
<a> {{$name}} </a>
@endsection

@section('back')
<a class="navbar-brand" href="{{ route('test.admin.show.index') }}">
    Back to admin
</a>
@endsection



@section('content')

<div class="container">
    <table>
        @foreach($items as $item)
            
       
            <div class="card">
                <div class="card-header h-1"> 
                    <div class="d-flex flex-row">
                        <div class="w-7 p-3" style="background-color: #eee;"> {{$id++}}</div>
                        <div class="d-flex p-2 align-items-center">{{$item->theme}}</div>
                      
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2  flex-grow-1"> {{$item->message}}</div>
                       
                        <div class="p-2">
                            <a href="{{ route('test.show.edit', $item->id) }}">
                                Edit |
                            </a>
                        </div>
                            
                        

                      
                        <div class="p-2">
                            <a href="{{route('test.show.destroy', $item->id)}}" data-method="delete" rel="nofollow">Удалить</a>
                        </div>
                         <!--   <form class="form-test" method="POST" action="{{route('test.show.destroy', $item->id)}}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" value="data">
                                <input type="submit" value="Отправить форму">
                           </form>
                        -->
                                <!--<button type="button" class="btn btn-primary align-item-end" onclick="{{ route('test.admin.show.edit', $item->id) }}">Edit</button>-->
                        
                        
                    </div>
                </div>
            </div>
           

        @endforeach	
    </table>
  
</div>
@endsection