<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudModel;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\Iterator\FilenameFilterIterator;

class FormController extends Controller
{
    public function index()
    {
        return view('test');
    }
    public function upload(Request $request)
    {
        // dd($request->name);
        // echo "<pre>";
        $filenames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {

                $filename = $file->getClientOriginalName();
                $file->storeAs('public/upload', $filename);
                $filenames[] = $filename;
            }
        }
        // die;
        $student = new CrudModel;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->qualification = $request->qualification;
        $student->file = json_encode($filenames);
        // dd($student);
        // die;
        $student->save();
        // return redirect('view')->with('message', 'Your data has been inserted successfully');
        return redirect()->route('view')->with('message', 'Your data has been inserted successfully');
    }
    public function ViewData(Request $request)
    {
        $search = $request->search;
        $message = '';
        if (!empty($search)) {
            $data = CrudModel::where('name', 'LIKE', "%$search%")->paginate(10);
            if ($data->isEmpty()) {
                $message = 'Data Not Found';
            }
            // dd($search);
            // die;
        } else {

            $data = CrudModel::orderby('id', 'desc')->paginate(10);
        }
        return view('view', compact('data', 'message'));
        // echo "<pre>";
        // var_dump($data);
    }
    public function editData($id)
    {
        $student =  CrudModel::find($id);

        if (!is_null($student)) {
            // $data = compact('student');
            // return view('test')->with($data);
            return view('test', compact('student'));
        } else {
            return redirect('/view');
        }
    }
    public function updateData($id, Request $request)
    {
        $filenames = [];

        $student =  CrudModel::find($id);
        // print_r($student);
        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {

                $filename = $file->getClientOriginalName();
                $file->storeAs('public/upload', $filename);
                $filenames[] = $filename;
                $student->file = json_encode($filenames);
            }
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->qualification = $request->qualification;

        $student->save();
        return redirect()->route('view')->with('message', 'Your data has been updated successfully');
    }
    public function deleteData($id)
    {
        $student = CrudModel::destroy($id);
        if (!is_null($student)) {
            // $student->delete();
            return redirect()->route('view')->with('message', 'Your data has been deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
