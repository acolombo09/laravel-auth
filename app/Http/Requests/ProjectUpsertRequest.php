<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectUpsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        
        $user = Auth::user(); //recupera l'utente attualmente loggato													
        if($user->email === "acolombo0911@hotmail.com") {
        // per questo progetto, mettere true di default in quanto ci sarà un solo account che farà login (l'admin->io)
        return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            "title" => "required|max:255",
            "description" => "required|string",
            "image" => "nullable|max:255",
            "link" => "required|string",
        ];
    }
}
