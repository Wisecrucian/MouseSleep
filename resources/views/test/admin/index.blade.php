@extends('layouts.app')

@section('content')
    @foreach($res as $key => $items)
    <a href="{{route("test.admin.userindex", $res[$key][0]->user_id)}}"> {{$key}}</a>
        <div class="container">
            <table>
                @foreach($items as $item)
                    
            
                    <div class="card">
                        <div class="card-header h-1"> 
                            <div class="d-flex flex-row">
                                <div class="w-7 p-2" style="background-color: #eee;"> {{$item->id}}</div>
                                <div class=" flex-grow-1 ">
                                    <div class="d-flex p-2 align-items-center">{{$item->theme}}</div>
                                </div>
                                    {{-- <div class="d-flex justify-content-end align-items-center">
                                        <a href="{{route("test.admin.userindex", $item->user->id)}}"> {{  $item->user->name}}</a>
                                    </div> --}}
                                </div>
                        
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="p-2  flex-grow-1"> {{$item->message}}</div>
                            
                                <div class="p-2">
                                    <a href="{{ route('test.admin.show.edit', $item->id) }}">
                                        Edit |
                                    </a>
                                </div>

                                <div class="p-2">
                                    <a href="{{route('test.admin.show.destroy', $item->id)}}" data-method="delete" rel="nofollow">Удалить</a>
                                </div>
                                        <!--<button type="button" class="btn btn-primary align-item-end" onclick="{{ route('test.admin.show.edit', $item->id) }}">Edit</button>-->
                                    
                                
                            </div>
                        </div>
                    </div>
                

                @endforeach	
            </table>
        
        </div>
    @endforeach
@endsection