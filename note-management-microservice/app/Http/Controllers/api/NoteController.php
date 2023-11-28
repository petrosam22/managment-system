<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NoteRequest;
use App\Services\NoteManagementService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Services\NoteManagementService as NoteService;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $noteManagementService;

     public function __construct(NoteService $noteManagementService)
     {
         $this->noteManagementService = $noteManagementService;
     }

     public function store(NoteRequest $request)
     {
        $response = $this->noteManagementService->createNote($request->all());


        return $response;
    }

    public function index(){
        $notes = Note::all();

        // Return the notes as a response
        return response()->json($notes);
    }

    public function edit($id){
        $note = Note::findOrFail($id);

        // Return the note as a response
        return response()->json($note);

     if(!$note){

         // Handle the case where the note with the given ID is not found
         return response()->json(['message' => 'Note not found'], 201);
        }
    }


     public function update($id,NoteRequest $request)

    {

        try {
            // Retrieve the note by ID
            $note = Note::findOrFail($id);
    
            // Update the note properties
            $note->title = $request['title'];
            $note->content = $request['content'];
            $note->user_id = $request['user_id'];
    
            // Save the updated note
            $note->save();
    
            // Return a success response
            return response()->json(['message' => 'Note updated successfully']);
    
        } catch ( Exception $e) {
            // Handle the case where the note with the given ID is not found
            return response()->json(['message' => 'Note not found'], 404);
        } catch (Exception $e) {
            // Handle any other exceptions that may occur
            return response()->json(['message' => 'Failed to update note'], 500);
    }
     
}


        public function delete($id){
            $note = Note::findOrFail($id);
            $note->delete();
            return response()->json([
                'message'=>'note Deleted successfully',
            ]);
        }






}
