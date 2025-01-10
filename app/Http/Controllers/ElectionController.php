<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElectionRequest;
use App\Http\Resources\ElectionResource;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    // A fileController controller
    private $fileController;

    /**
     * Summary of __construct: A election controller constructor
     * @param \App\Http\Controllers\FileController $fileController
     */
    public function __construct(FileController $fileController)
    {
        $this->fileController = $fileController;
    }

    /**
     * Summary of deleteElectionByID: A public function that deletes an election record by ID
     * @param string $election_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteElectionByID(String $election_id)
    {

        // Find election by ID
        $election = Election::findOrFail($election_id);

        // Delete record
        $election->delete();

        // Return response
        return $this->jsonResponse([
            'message' => 'Election is deleted',
        ], 200);
    }

    /**
     * Summary of addNewElection: A public function that creates new election record.
     * @param \App\Http\Requests\ElectionRequest $electionRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addNewElection(ElectionRequest $electionRequest)
    {
        // Get validated 
        $validated = $electionRequest->validated();

        // Check if image does exist
        if ($electionRequest->hasFile('image')) {

            // Upload and return url
            $validated['image_url'] = $this->fileController->uploadFile($electionRequest, 'image', 'elections', 'public');
        }

        // Create a new election using the validated data
        $election = Election::create($validated);

        // Return response
        return $this->jsonResponse([
            'message' => 'A new election is created',
            'data' => new ElectionResource($election)
        ], 201);
    }
}
