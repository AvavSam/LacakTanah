<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'can:admin']);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::where('role', 'user')->paginate(15);
    return view('users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('users.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    $data['role'] = 'user';

    User::create($data);

    return redirect()
      ->route('users.index')
      ->with('success', 'User baru berhasil dibuat.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $user = User::findOrFail($id);
    $data = $request->validated();

    if (! empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    } else {
      unset($data['password']);
    }

    $user->update($data);

    return redirect()
      ->route('users.index')
      ->with('success', 'User berhasil diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()
      ->route('users.index')
      ->with('success', 'User berhasil dihapus.');
  }
}
