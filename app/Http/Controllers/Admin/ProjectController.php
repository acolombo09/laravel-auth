<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller {
    // index utente admin
    public function index(): View {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    public function create(): View {
        return view("admin.projects.create");
    }

    public function store(Request $request): RedirectResponse {
        $data = $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "image" => "nullable|string",
            "link" => "required|string",
        ]);

        // fill e save
        $project = Project::create($data);

        return redirect()->route("admin.projects.show", $project->title);
    }

    public function show(string $title): View {
        
        $project = Project::where("title", $title)->first();

        return view("admin.projects.show", compact("project"));
    }

    public function edit(string $title): View
    {
        $project = Project::where("title", $title)->firstOrFail();

        return view("admin.projects.edit", compact("project"));
    }
}
