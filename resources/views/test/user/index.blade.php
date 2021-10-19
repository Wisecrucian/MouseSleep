@extends('layouts.app')

@section('content')

<div class="d-flex flex-row">

    @if(count($items) > 0)
        <div class="p-2 flex-fill">
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
        </div>
    @endif
   

    @if($res != NULL)
        <div class="p-2 flex-fill">
            <div class="d-flex flex-column">
                @foreach($res as $key => $posts)
                    <div> {{ $key }} </div>
                        <div class="p-2 flex-fill">
                            <div class="container">
                                <table>
                            
                                    @foreach($posts as $post)
                                    
                                        <div class="card">
                                            <div class="card-header h-1"> 
                                            <div class="d-flex flex-row">
                                                <div class="w-7 p-3" style="background-color: #eee;"> {{$id1++}}</div>
                                                <div class="d-flex p-2 align-items-center">{{$post->theme}}</div>
                                            
                                                
                                            </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-row">
                                                    <div class="p-2  flex-grow-1"> {{$post->message}}</div>
                                            
                                                {{-- <div class="p-2">
                                                    <a href="{{ route('test.show.edit', $post->id) }}">
                                                        Edit |
                                                    </a>
                                                </div>
                                                    
                                                

                                            
                                                <div class="p-2">
                                                    <a href="{{route('test.show.destroy', $post->id)}}" data-method="delete" rel="nofollow">Удалить</a>
                                                </div> --}}
                                            
                                                
                                                
                                                    </div>
                                                </div>
                                        </div>
                                

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>


@endsection