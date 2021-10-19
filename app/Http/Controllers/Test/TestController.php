<?php

namespace App\Http\Controllers\Test;


use App\Http\Controllers\Test\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Models\UserInfo;
use App\Models\Visible;
use App\User;




class TestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $items= UserInfo::where('user_id', '=', Auth::id())->get();
        $itemsvisible= Visible::where('user_id', '=', Auth::id())->get();

        $posts1 = [];
        $counts = [];
        $res = [];
       
        
        foreach($itemsvisible as $item)
        {
            array_push($posts1, $item->post_id);
            $co = UserInfo::where('id', '=', $item->post_id)->get();
            
            if(!in_array($co[0]->user()->get()[0], $counts)) array_push($counts, $co[0]->user()->get()[0]);
            
        }

        $posts = UserInfo::whereIn('id',  $posts1)->get();

        foreach($counts as $count){
            $res[$count->name] = $posts->where('user_id', '=', $count->id);
        }
        
        $id = 1;
        $id1 = 1;
       

       //dump($items);
        return view('test.user.index', compact('items', 'id', 'id1', 'res'));
      
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Auth::user();
        $users = User::where('name', '!=', 'Max')->where('name', '!=', Auth::user()->name)->get();
        
        
       return view('test.user.create', compact('item', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(UserInfo::count() == 0) $id = 1;
        else $id =  UserInfo::latest('id')->first()->id + 1;

        
        if(Visible::all()->count() == 0) $idv = 1;
        else $idv =  Visible::latest('id')->first()->id + 1;

        
        $data = [
            'id' => $id,
            'user_id' => Auth::id(),
            'theme' => $request->theme,
            'message' => $request->message,
        ];

       
      
         //echo $data['id'];

        $result = UserInfo::create($data);

        if(isset($request->users))
        {
            foreach($request->users as $user)
            {
                
                $datavisibility = [
                    'id' => $idv,
                    'post_id' => $id,
                    'user_id' => $user,
                ];

                Visible::create($datavisibility);
                $idv++;
            }
        }

        if($result)
        {
            return redirect()->route('test.show.index')->with(['success'=>"Успешно сохранено"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = UserInfo::FindorFail($id);

        $categoryList = UserInfo::all();


        return view('test.user.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = UserInfo::find($id);

        if(empty($item))
        {
            return back()->withErrors(['msg'=>"Запись id = [{$id}]не найдена"])->withInput();
        }
        $item->fill($request->all());

        //echo $item->message;
        $result = $item->save();

        if($result)
        {
            return redirect()->route('test.show.index', $id)->with(['success'=>"Успешно сохранено"]);
        }
        else return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        
        $userinfos = UserInfo::where('id', '>=', $id)->get();
        $visibilitiesinfos = Visible::where('post_id', '>=', $id)->get();
        

        foreach($visibilitiesinfos as $vis)
        {
            dump($id);
            if($vis->post_id == $id)
            {
                $vis->delete();
                continue;
            }
            else $vis->post_id = $id;
            $vis->save();
        }

        foreach($userinfos as $value)
        {
            
            if($value->id == $id)
            {
                $value->delete();
                continue;
            }
            else $value->id = $id;
            $value->save();
        }

        
      

       
        return redirect()->route('test.show.index');
       
    }
}
