<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('lecturer.index')
      ->with('lecturers', Lecturer::with('students')->get());
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('lecturer.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'nik' => ['required', 'string', 'max:7', 'unique:lecturer,nik'],
      'name' => ['required', 'string', 'max:100'],
      'birth_date' => ['required'],
      'email' => ['required', 'email', 'max:50', 'unique:lecturer,email'],
    ]);
    $lecturer = new Lecturer($validatedData);
    $lecturer->save();
    return redirect()->route('admin.lecturer.index')
      ->with('status', 'Lecturer successfully added!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Lecturer $lecturer)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $nik)
  {
    $lecturer = Lecturer::find($nik);
    if ($lecturer == null) {
      return back()->withErrors(['err_msg' => 'Lecturer not found!']);
    }
    return view('lecturer.edit')
      ->with('lecturer', $lecturer);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $nik)
  {
    $lecturer = Lecturer::find($nik);
    if ($lecturer == null) {
      return back()->withErrors(['err_msg' => 'Lecturer not found!']);
    }
    $validatedData = $request->validate([
      'nik' => ['required', 'string', 'max:7', Rule::unique('lecturer', 'nik')->ignore($lecturer->nik, 'nik')],
      'name' => ['required', 'string', 'max:100'],
      'birth_date' => ['required'],
      'email' => ['required', 'email', 'max:50', Rule::unique('lecturer', 'email')->ignore($lecturer->nik, 'nik')],
    ]);
    $lecturer['name'] = $validatedData['name'];
    $lecturer['birth_date'] = $validatedData['birth_date'];
    $lecturer['email'] = $validatedData['email'];
    $lecturer->save();
    return redirect()->route('admin.lecturer.index')
      ->with('status', 'Lecturer successfully updated!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $nik)
  {
    $lecturer = Lecturer::find($nik);
    if ($lecturer == null) {
      return back()->withErrors(['err_msg' => 'Lecturer not found!']);
    }
    if (count($lecturer->students) > 0) {
      return back()->withErrors(['err_msg' => 'Delete error. This lecturer has been assigned to supervise student(s)!']);
    }
    $lecturer->delete();
    return redirect()->route('admin.lecturer.index')
      ->with('status', 'Lecturer successfully deleted!');
  }
}
