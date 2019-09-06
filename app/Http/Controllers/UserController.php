<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function buildTree($level = 0)
    {
        $users = User::with('children')->where('parent_id', $level)->get();
        return view('tree', [
            'users' => $users,
            'delimiter' => '',
        ]);
    }

    public function sort(Request $request)
    {
        $sort = User::query();
        $name = $request->input('users_sort');
        if($name){
            $sort= $sort->orderBy($name)->paginate(16);
        }
        else{
            $sort= $sort->paginate(16);
        }
        return view('list', [
            'users' => $sort,
        ]);
    }

    public function filter(Request $request)
    {
        $qb = User::query();

        if($request->get('surname')){
            $qb->where('surname', 'like', $request->get('surname').'%');
        }
        if($request->get('name')){
            $qb->where('name', 'like', $request->get('name').'%');
        }
        if($request->get('email')){
            $qb->where('email', 'like', $request->get('email').'%');
        }
        if($request->get('position')){
            $qb->where('position', 'like', $request->get('position').'%');
        }
        if($request->get('employment_date')){
            $qb->where('employment_date', 'like', $request->get('employment_date').'%');
        }

        return view('list', [
            'users' => $qb->paginate(20),
        ]);
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $surname = $request->surname;
        $position = $request->position;
        $employment_date = $request->employment_date;

        $users = User::query();
        if($name){
            $users = $users->where('name', 'like', $name.'%');
        }
        if($surname){
            $users = $users->where('surname', 'like', $surname.'%');
        }
        if($email){
            $users = $users->where('email', 'like', $email.'%');
        }
        if($position){
            $users = $users->where('position', 'like', $position.'%');
        }
        if($employment_date){
            $users = $users->where('employment_date', 'like', $employment_date.'%');
        }
        return response()->json($users->get()->toArray());
    }

    public function showCreateForm()
    {
        return view('edit');
    }

    public function showEditForm($id)
    {
        $user = User::find($id);
        if ($user === null) {
            abort(404);
        }
        return view('edit', [
            'user' => $user,
        ]);
    }

    public function remove($id)
    {
        $user = User::find($id);
        if($user === null){
            abort(404);
        }
        $user->delete();
        return redirect(route('admin.filter'));
    }

    public function store(Request $request, $id = null)
    {
        $user = new User();
        if($id){
            $user = User::find($id);
        }
        if($request->get('bosses')) {
            $user->parent_id = $request->get('bosses');
        }
        $fields = ['parent_id', 'name', 'surname', 'email', 'position', 'employment_date'];
        if($request->get('password')){
            $user->password = \Hash::make($request->get('password'));
        }

        $user->fill($request->only($fields));
        $user->save();
        return redirect(route('admin.filter'));
    }
}
