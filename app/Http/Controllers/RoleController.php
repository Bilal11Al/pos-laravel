<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\Role;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $role = Role::orderBy('id', 'DESC')->get();
    $title = 'Data Role';
    return view('roles.index', compact('role', 'title'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('roles.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // $request->validate([
    //     'name' => 'required|string',
    // ]);

    // Category::create([
    //     'name' => $request->name,
    // ]);
    Role::create($request->all());
    alert()->success('Success', 'data created successfully ');
    return redirect()->to('role');
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
    $role = Role::find($id);
    return view('roles.create', compact('role'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $role = Role::find($id);
    // $request->validate([
    //     "name" => 'required|string',
    // ]);

    // $datas = [
    //     'name' => $request->name,
    // ];
    // $category->update($datas);
    $role->name = $request->name;
    $role->save();
    alert()->success('Success', 'data Updated successfully ');
    return redirect()->route('role.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Role::find($id)->delete();
    alert()->success('Success', 'data Deleted successfully ');
    return redirect()->route('role.index');
  }
}
