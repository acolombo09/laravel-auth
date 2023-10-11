<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpsertRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller {
    // INDEX utente admin
    public function index(): View {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    // CREATE
    public function create(): View {
        return view("admin.projects.create");
    }

    // STORE
    public function store(ProjectUpsertRequest $request): RedirectResponse {
        // modificata in validated a seguito della creazione dello store request
        // ho già i dati validati, non serve validarli di nuovo
        $data = $request->validated();

        // invoco la funzione generateSlug passando il titolo come argomento per generare lo slug
        // aggiungo lo stesso blocco di codice nella function update
        $data["slug"] = $this->generateSlug($data["title"]);

        // fill e save
        $project = Project::create($data);

        return redirect()->route("admin.projects.show", $project->slug);
    }

    // SHOW
    public function show(string $slug): View {
        // con first, recupero il primo elemento slug 
        $project = Project::where("slug", $slug)->first();

        return view("admin.projects.show", compact("project"));
    }

    // EDIT
    public function edit(string $slug): View
    {
        $project = Project::where("slug", $slug)->firstOrFail();

        return view("admin.projects.edit", compact("project"));
    }

    // UPDATE
    public function update(ProjectUpsertRequest $request, $slug) {
        $data = $request->validated();
        $project = Project::where("slug", $slug)->firstOrFail();

        // a questo punto dovrei rifare il procedimento per lo slug per aggiornarlo,
        // ma non ha senso faccio prima a controllare se è cambiato o no
        // nel mio caso solo il titolo (che corrisponde allo slug)
        if ($data["title"] !== $project->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }

        // se la checkbox è spuntata, il server riceve il valore della checkbox
        // altrimenti, il server non riceve il valore della checkbox ma inserisce null
        if (isset($data["is_published"])) {
            $project->is_published = true;
            $project->published_at = now();
            // $project->save();
        }else {
            $project->is_published = false;
            $project->published_at = null;
            // $project->save();
        }

        // spostando l'update dopo l'if di is published, posso evitare di inserire i due save
        $project->update($data);
        

        return redirect()->route("admin.projects.show", $project->slug);
    }

    protected function generateSlug($title){
        // uso un contatore per avere un numero incrementale nel caso ho lo stesso titolo
        $counter = 0;

        do{
            // creo uno slug e se il counter è > 0, concateno il counter con l'incremento
            $slug = Str::slug($title) . ($counter > 0 ? "-" . $counter : "");

            // creo una variabile da utilizzare per capire se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first(); // first coerente col do while
            
            // assegno l'incremento al contatore
            $counter++;
        } while ($alreadyExists); // finché esiste già un elemento con questo slug, ripeto il ciclo per creare uno slug nuovo

        return $slug;
    }

    public function destroy($slug) {
        $project = Project::where("slug", $slug)->firstOrFail();
        $project->delete();
        return redirect()->route("admin.projects.index");
    }
}
