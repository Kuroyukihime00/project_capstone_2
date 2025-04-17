<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('student.index')
      ->with('students', Student::with('academicSupervisor')->get());
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('student.create')
      ->with('lecturers', Lecturer::all());
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'nrp' => ['required', 'string', 'max:9', 'unique:students,nrp'],
      'name' => ['required', 'string', 'max:100'],
      'birth_date' => ['required'],
      'phone' => ['required', 'numeric'],
      'email' => ['nullable', 'email', 'max:50', 'unique:students,email'],
      'address' => ['required', 'string', 'max:300'],
      'lecturer_nik' => ['required', 'string'],
      'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    ]);
    $student = new Student($validatedData);
    if ($request->hasFile('profile_picture')) {
      $file = $request->file('profile_picture');
      $newFileName = $validatedData['nrp'] . '.' . $file->getClientOriginalExtension();
      $file->storePubliclyAs('students_picture', $newFileName);
      $student['profile_picture'] = $newFileName;
    }
    $student->save();
    return redirect()->route('admin.student.index')
      ->with('status', 'Student successfully added!');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $nrp)
  {
    $student = Student::find($nrp);
    if ($student == null) {
      return back()->withErrors(['err_msg' => 'Student not found!']);
    }
    return view('student.detail')
      ->with('student', $student);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $nrp)
  {
    $student = Student::find($nrp);
    if ($student == null) {
      return back()->withErrors(['err_msg' => 'Student not found!']);
    }
    return view('student.edit')
      ->with('lecturers', Lecturer::all())
      ->with('student', $student);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $nrp)
  {
    $student = Student::find($nrp);
    if ($student == null) {
      return back()->withErrors(['err_msg' => 'Student not found!']);
    }
    $validatedData = $request->validate([
      'nrp' => ['required', 'string', 'max:9', Rule::unique('student', 'nrp')->ignore($student->nrp, 'nrp')],
      'name' => ['required', 'string', 'max:100'],
      'birth_date' => ['required'],
      'phone' => ['required', 'numeric'],
      'email' => ['nullable', 'email', 'max:50', Rule::unique('student', 'email')->ignore($student->nrp, 'nrp')],
      'address' => ['required', 'string', 'max:300'],
      'lecturer_nik' => ['required', 'string'],
      'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    ]);
    $student['name'] = $validatedData['name'];
    $student['birth_date'] = $validatedData['birth_date'];
    $student['phone'] = $validatedData['phone'];
    $student['email'] = $validatedData['email'];
    $student['address'] = $validatedData['address'];
    $student['lecturer_nik'] = $validatedData['lecturer_nik'];
    if ($request->hasFile('profile_picture')) {
      unlink('storage/students_picture/' . $student->profile_picture);
      $file = $request->file('profile_picture');
      $newFileName = $validatedData['nrp'] . '.' . $file->getClientOriginalExtension();
      $file->storePubliclyAs('students_picture', $newFileName);
      $student['profile_picture'] = $newFileName;
    }
    $student->save();
    return redirect()->route('admin.student.index')
      ->with('status', 'Student successfully updated!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $nrp)
  {
    $student = Student::find($nrp);
    if ($student == null) {
      return back()->withErrors(['err_msg' => 'Student not found!']);
    }
    if ($student->profile_picture != null) {
      unlink('storage/students_picture/' . $student->profile_picture);
    }
    $student->delete();
    return redirect()->route('admin.student.index')
      ->with('status', 'Student successfully deleted!');
  }
}
