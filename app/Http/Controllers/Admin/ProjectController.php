<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {
    // index utente admin
    public function index() {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    public function show($id) {
        $project = Project::findOrFail($id);

        return view("admin.projects.show", compact("project"));
    }
    public function create() {
        return view("admin.project.create");
    }

    public function store(Request $request) {
        $data = $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "image" => "nullable|string",
            "language" => "nullable|string",
            "link" => "required|string",
        ]);

        $data["language"] = json_encode([$data["language"]]);

        // fill e save
        $project = Project::create($data);

        return redirect()->route("admin.projects.show", $project->title);
    }
}
