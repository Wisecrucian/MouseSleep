<?php

namespace App\Http\Controllers\Test\Admin;

use Auth;
use App\Models\UserInfo;
use App\User;
use App\Models\Visible;
use Illuminate\Http\Request;

class MessagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $items= UserInfo::all();
        $users = User::all();


       
        $res = [];

        foreach($users as $user)
        {
            $res[$user->name] = $user->userinfos()->get();
        }

        //dump($res);
        return view('test.admin.index', compact('items', 'users', 'res'));
    }


    public function userindex(Request $request)
    {
       
        $items= UserInfo::where('user_id', '=', $request->id)->get();
        $name = $items[0]->user->name;
        $id = 1;
      
       return view('test.admin.userindex', compact('items', 'name', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Auth::user();
        $users = User::where('name', '!=', 'Max')->get();
        return view('test.admin.create', compact('item', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo dd($request->users);
      
        if(UserInfo::all()->count() == 0) $id = 1;
        else $id =  UserInfo::latest('id')->first()->id + 1;

        if(Visible::all()->count() == 0) $idv = 1;
        else $idv =  Visible::latest('id')->first()->id + 1;

        $data = [
            'id' => $id,
            'user_id' => Auth::id(),
            'theme' => $request->theme,
            'message' => $request->message,
        ];

        $result = UserInfo::create($data);
       

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
        

        if($result)
        {
            return redirect()->route('test.admin.show.index')->with(['success'=>"Успешно сохранено"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($show)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($show)
    {
        $item = UserInfo::FindorFail($show);

        $categoryList = UserInfo::all();


        return view('test.admin.edit', compact('item', 'categoryList'));
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
        // $request->validate([
        //     'theme' => 'required|max:20', 
        //     'message' => 'required|max:50',
        // ]);

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
            return redirect()->route('test.admin.show.index', $id)->with(['success'=>"Успешно сохранено"]);
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

      
        
       
        return redirect()->route('test.admin.show.index');
    }
}
