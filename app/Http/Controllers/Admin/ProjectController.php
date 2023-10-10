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
            "title" => "required|max:255",
            "description" => "required|string",
            "image" => "nullable|max:255",
            "link" => "required|string",
        ]);

        // uso un contatore per avere un numero incrementale nel caso ho lo stesso titolo
        $counter = 0;

        do{
            // creo uno slug e se il counter è > 0, concateno il counter con l'incremento
            $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");

            // creo una variabile da utilizzare per capire se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first(); // first coerente col do while
            
            // assegno l'incremento al contatore
            $counter++;
        } while ($alreadyExists); // finché esiste già un elemento con questo slug, ripeto il ciclo per creare uno slug nuovo

        $data["slug"] = $slug; 

        // fill e save
        $project = Project::create($data);

        return redirect()->route("admin.projects.show", $project->slug);
    }

    public function show(string $slug): View {
        // con first, recupero il primo elemento slug 
        $project = Project::where("slug", $slug)->first();

        return view("admin.projects.show", compact("project"));
    }

    public function edit(string $slug): View
    {
        $project = Project::where("slug", $slug)->firstOrFail();

        return view("admin.projects.edit", compact("project"));
    }
}
