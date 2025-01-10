<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurricularLogoRequest;
use App\Models\Curricular;
use Illuminate\Http\Request;

class CurricularController extends Controller
{
    private $fileController;

    public function __construct(FileController $fileController) {
        $this->fileController = $fileController;
    }

    /**
     * Summary of uploadLogoByID: A public function that updates the curricular logo by ID.
     * @param \App\Http\Requests\CurricularLogoRequest $curricularLogoRequest
     * @param string $curricular_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function uploadLogoByID(CurricularLogoRequest $curricularLogoRequest, String $curricular_id) {

        // Check if logo does exist
        if(!($curricularLogoRequest->hasFile('logo'))) {
            return $this->jsonResponse('File logo not found.', 404);
        }

        // Find Curricular by ID
        $curricular = Curricular::findOrFail($curricular_id);

        // Store the file logo
        $url = $this->fileController->uploadFile($curricularLogoRequest, 'logo', 'curricular_logo', 'public');

        // Update and save
        $curricular->logo_url = $url;
        $curricular->save();

        // Return
        return $this->jsonResponse([
            'message' => 'Logo updated.',
            'data' => $url
        ], 200);

    }
}
