<?php

namespace App\Http\Controllers;

use App\Module;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    protected $base;

    public function __construct(BaseRepository $baseRepository)
    {
        $this->base = $baseRepository;

        parent::__construct();
    }

    public function index()
    {
        if(Auth::user()->role_id == 3){
            $modules = Module::orderBy('name')->get();
        }else{
            $modules = Module::where('user_id', Auth::user()->id)->orderBy('name')->get();
        }

        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        return view('modules.create');
    }

    public function store(Request $request)
    {
        Module::create($request->all());

        return redirect('/modules');
    }

    public function edit($id)
    {
        $module = $this->base->getByModuleId($id);

        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, $id)
    {
        $course = $this->base->getByModuleId($id);

        $course->update($request->all());

        return redirect('/modules');
    }

    public function destroy($id)
    {
        $course = $this->base->getByModuleId($id);

        $course->delete();

        return back();
    }
}
