<?php

namespace App\Http\Controllers;

use App\Models\Statue;
use App\Models\Report;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{   
    private function isAdminByEmail($email)
    {
        return Auth::check() && Auth::user()->email === $email;
    }
    
  //  private function isAdmin()
  //  {
  //      return Auth::check() && Auth::user()->role === 'admin';
  //  }
    public function adminIndex()
    {
    //    if (!$this->isAdmin()) {
    //        abort(403, 'Недостаточно полномочий для доступа к этой странице.');
    //    }
    if (!$this->isAdminByEmail('admin@mail.com')) {
       abort(403, 'Недостаточно полномочий для доступа к этой странице.');
    }
        $reports = Report::paginate(10);
        $sections = Section::all();

        return view('admin', compact('reports', 'sections'));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->section_id = $request->input('section_id');
        $report->save();

        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_id' => 'required|exists:section,id',
        ]);

        $report = Report::findOrFail($id);
        $report->statues_id = $request->section_id;
        $report->save();

        return redirect()->route('admin.index')->with('success', 'Статус обновлён успешно!');
    }



    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->paginate(10);
        return view('welcome', ['reports' => $reports]);
    }

    public function create()
    {
        // $services = Service::all();
        $sections = Section::all();

        return view('request', compact('sections'));
    }

    public function store(Request $request)
    {
        try{


            $data = $request->validate([
                'fullname' => 'required|string|max:255',
                'path_img' => 'required|image|mimes:png,jpg,jpeg,gif|max:4096',
                'theme' => 'required|string|max:255',
                'section_id' => 'required|exists:sections,id',
            ]);

            $imageName = time() . '.' . $request->path_img->extension();
            $request->path_img->storeAs('reports', $imageName, 'public');
            $request->path_img->move(public_path('image'), $imageName);
            
            Report::create([
                'fullname' => $data['fullname'],
                'path_img' => $imageName,
                'theme' => $data['theme'],
                'section_id' => $data['section_id'],
                'user_id' => Auth::id(),
            ]);
            
            return redirect('/')->with('message', 'Создание заявки успешно!');
        }catch( \Exception $e){
            Log::error('Ошибка при создании отчета: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Произошла ошибка при создании заявки.');
        }
    }
}
