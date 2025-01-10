<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    /**
     * Summary of updatePositionByID: A public function that updates the position by ID.
     * @param \App\Http\Requests\PositionRequest $positionRequest
     * @param string $position_id
     * @return void
     */
    public function updatePositionByID(PositionRequest $positionRequest, String $position_id)
    {

        // Get validated
        $validated = $positionRequest->validated();

        // Find position record by ID
        $position = Position::findOrFail($position_id);

        // Update
        $position->update($validated);

        // Return response
        return $this->jsonResponse([
            'message' => 'Positon is created.',
            'data' => new PositionResource($position)
        ], 200);
    }

    /**
     * Summary of getAllPositionsByElection: A public function that gets all positions by election (ID)
     * @param string $election_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllPositionsByElection(String $election_id)
    {

        // Find positions by election
        $positions = Position::where('election_id', $election_id);

        // Return response
        return PositionResource::collection($positions);
    }

    /**
     * Summary of addNewPosition: A public function that adds new position
     * @param \App\Http\Requests\PositionRequest $positionRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addNewPosition(PositionRequest $positionRequest)
    {
        // Get validated
        $validated = $positionRequest->validated();

        // Create new position record
        $position = Position::create($validated);

        // Return resource
        return $this->jsonResponse([
            'message' => 'Positon is created.',
            'data' => new PositionResource($position)
        ], 201);
    }

    /**
     * Summary of deletePositionByID: A public function that deletes a position record by ID.
     * @param string $position_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deletePositionByID(String $position_id)
    {
        // Find position record
        $position = Position::findOrFail($position_id);

        // Delete record
        $position->delete();

        // Return resource
        return $this->jsonResponse([
            'message' => 'Positon is deleted.',
        ], 200);
    }
}
