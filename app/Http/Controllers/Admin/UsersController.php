<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $user_query = User::query();
    $sortColumn = $request->query('sortColumn');
    $sortDirection = $request->query('sortDirection');
    $searchParam = $request->query('q');

    if($sortColumn && $sortDirection) {
      $user_query->orderBy($sortColumn, $sortDirection ?: 'asc');
    }

    if($searchParam){
      $user_query = $user_query->where(function($query) use ($searchParam) {
        $query
          ->orWhere('name', 'like', "%$searchParam%")
          ->orWhere('email', 'like', "%$searchParam%");
      });
    }
    // $users = User::all();
    $users = $user_query->paginate(5);

    return view('admin.users', compact('users', 'sortColumn', 'sortDirection', 'searchParam'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'email|required|unique:users',
      'password' => 'required|min:6',
    ]);

    User::create([
      'name' => request('name'),
      'email' => request('email'),
      'password' => bcrypt(request('password')),
    ]);

    return redirect(route('admin.users'))->with('success', 'Pengguna berhasil disimpan!');
  }

  public function edit($id)
  {
    $user = User::find($id);
    return response()->json([
      'status' => 200,
      'user' => $user
    ]);
  }

  public function update(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|unique:users,email,' . $request->user_id
    ]);

    $user = User::findOrFail($request->user_id);

    $params = [
      'name' => $request->name,
      'email' => $request->email,
    ];

    if(strlen($request->password) > 1) {
      $params['password'] = bcrypt($request->password);
    }

    DB::table('users')->where(['id' => $request['user_id']])->update($params);

    return redirect(route('admin.users'))->with('success', 'Pengguna berhasil diubah!');
  }

  public function delete(Request $request)
  {
    $user = User::find($request->id);
    Storage::delete(placed_storage() . $user->image);
    $user->delete();

    return response()->json(['status' => 200]);
  }
}
