<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Position;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    // A fileController Controller
    private $fileController;

    // CandidateController constructor
    public function __construct(FileController $fileController)
    {
        $this->fileController = $fileController;
    }

    /**
     * Summary of attemptUploadFiles: A private function that attempts to upload files if each keys does exist
     * @param \Illuminate\Http\Request $request
     * @param array $validated
     * @return array
     */
    private function attemptUploadFiles(Request $request, array $validated)
    {

        // Check if photo does exist
        if ($request->hasFile('photo')) {
            // Upload and return url
            $validated['photo_url'] = $this->fileController->uploadFile($request, 'photo', 'candidates', 'public');
        }

         // Check if cor does exist
         if ($request->hasFile('cor')) {
            // Upload and return url
            $validated['cor_url'] = $this->fileController->uploadFile($request, 'cor', 'candidates', 'public');
        }

        // Check if grades does exist
        if ($request->hasFile('grades')) {
            // Upload and return url
            $validated['grades_url'] = $this->fileController->uploadFile($request, 'grades', 'candidates', 'public');
        }

        // Check if moral does exist
        if ($request->hasFile('moral')) {
            // Upload and return url
            $validated['moral_url'] = $this->fileController->uploadFile($request, 'moral', 'candidates', 'public');
        }

         // Check if certificate does exist
         if ($request->hasFile('certificate')) {
            // Upload and return url
            $validated['certificate_url'] = $this->fileController->uploadFile($request, 'certificate', 'candidates', 'public');
        }

        // Return validated array
        return $validated; 

    }

    /**
     * Summary of addNewCandidate: A public function that adds new candidate.
     * @param \App\Http\Requests\CandidateRequest $candidateRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addNewCandidate(CandidateRequest $candidateRequest)
    {
        // Get validated
        $validated = $candidateRequest->validated();

        // Find position
        $position = Position::findOrFail($validated['position_id']);

        // Check if the max_candidates limit is reached
        $currentCandidatesCount = $position->candidates()->count();
        if ($currentCandidatesCount >= $position->max_candidates) {
            // Return an error if the max candidates limit is reached
            $this->jsonResponse([
                'message' => 'Max candidates limit reached for this position'
            ], 400);
        }

        // Increment max_candidates by 1
        $position->increment('max_candidates');

        /**
         * - Attempt to check files
         * - Upload files to the local storage
         */
        $validated = $this->attemptUploadFiles($candidateRequest, $validated);

        // Create new candidate
        $candidate = Candidate::create($validated);

        // Return response
        return $this->jsonResponse([
            'message' => 'A candidate is created',
            'data' => new CandidateResource($candidate)
        ], 201);
    }

    /**
     * Summary of getAllCandidates: A public function that gets all candidates.
     * @param \Illuminate\Http\Request $request
     * @param string $election_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllCandidates(Request $request, String $election_id)
    {

        // Find Election by ID
        $election = Election::findOrFail($election_id);

        // Get all candidates by election ID
        $candidates = Candidate::with(['user', 'position'])->whereHas('position', function ($query) use ($election) {
            $query->where('election_id', $election->id);
        });

        // Return resources
        return CandidateResource::collection($candidates);
    }
}
