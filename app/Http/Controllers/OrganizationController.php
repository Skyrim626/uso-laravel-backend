<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationLogoRequest;
use App\Http\Requests\OrganizationNameRequest;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrganizationController extends Controller
{

    protected $fileController;

    public function __construct(FileController $fileController) {
        $this->fileController = $fileController;
    }
    
    /**
     * Summary of getOrganizationByID: A public function that gets an organization by ID.
     * @param string $organization_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getOrganizationByID(String $organization_id) {

        // Find organization by ID
        $organization = Organization::findOrFail($organization_id);

        // Return
        return $this->jsonResponse(new OrganizationResource($organization), 200);
    }

    /**
     * Summary of updateOrganizationNameByID: A public function that updates the organization name by ID.
     * @param \App\Http\Requests\OrganizationNameRequest $organizationNameRequest
     * @param string $organization_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateOrganizationNameByID(OrganizationNameRequest $organizationNameRequest, String $organization_id) {

        // Get validated 
        $validated = $organizationNameRequest->validated();
        
        // Find organization by ID
        $organization = Organization::find($organization_id);

        // Update and save
        $organization->name = $validated['name'];
        $organization->save();

        // Return
        return $this->jsonResponse([
            'message' => "Organization name is changed.",
        ], 200);
    }

    /**
     * Summary of joinOrganizationByID: A public function that allows to join an organization.
     * @param string $organization_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function joinOrganizationByID(String $organization_id)
    {

        // Get authenticated user
        $authUser = Auth::user();

        // Find organization by ID
        $organization = Organization::findOrFail($organization_id);
        $organization->users()->attach($authUser->id, ['status' => 'pending']);

        // Return a detailed success response
        return $this->jsonResponse([
            'message' => 'You have successfully requested to join the organization.',
            'data' => [
                'user_id' => $authUser->id,
                'organization_id' => $organization->id,
                'status' => 'pending',
                'organization_name' => $organization->name
            ]
        ], 201);
    }

    /**
     * Summary of deleteOrganizationByID: A public function that deletes an organization by ID.
     * @param string $organization_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteOrganizationByID(String $organization_id)
    {
        // Find organization by ID
        $organization = Organization::findOrFail($organization_id);

        // Delete record
        $organization->delete();

        // Return a success response
        return $this->jsonResponse([
            'message' => 'Organization deleted successfully!',
        ], 200);
    }

    /**
     * Summary of updateOrganizationByID: A public function that updates the organization by ID.
     * @param \App\Http\Requests\OrganizationRequest $organizationRequest
     * @param string $organization_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateOrganizationByID(OrganizationRequest $organizationRequest, String $organization_id)
    {
        // Get validated
        $validated = $organizationRequest->validated();

        // Find organization by ID
        $organization = Organization::findOrFail($organization_id);

        // Update and save
        $organization->update($validated);

        // Return a success response
        return $this->jsonResponse([
            'message' => 'Organization updated successfully!',
            'organization' => $organization,
        ], 201);
    }

    /**
     * Summary of checkAndUploadLogo: A private function that uploads the organization logo.
     * @param \Illuminate\Http\Request $request
     * @param array $validated
     * @return array
     */
    private function checkAndUploadLogo(Request $request, array $validated) {

        // Check if image does exist
        if ($request->hasFile('logo')) {

            // Upload and return url
            $validated['logo_url'] = $this->fileController->uploadFile($request, 'logo', 'organizations', 'public');
        }
        // Log::info($request);
        // Return array
        return $validated;

    }

    /**
     * Summary of uploadLogo: A public function that uploads the organization logo by ID.
     * @param \App\Http\Requests\OrganizationLogoRequest $organizationLogoRequest
     * @param string $organization_id
     * @return void
     */
    public function uploadLogo(OrganizationLogoRequest $organizationLogoRequest, String $organization_id) {

        // Get validated
        $validated = $organizationLogoRequest->validated();

         // Check if image does exist
        $validated = $this->checkAndUploadLogo($organizationLogoRequest, $validated);

        // Find Organization by ID
        $organization = Organization::findOrFail($organization_id);

        // Update and save
        $organization->logo_url = $validated['logo_url'];
        $organization->save();

        // Return 
        return $this->jsonResponse([
            'message' => "Logo is updated",
            'url' => $validated['logo_url']
        ], 200);
    }
    
    /**
     * Summary of addNewOrganization: A public function that creates a new organization record.
     * @param \App\Http\Requests\OrganizationRequest $organizationRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addNewOrganization(OrganizationRequest $organizationRequest)
    {

        // Get validated
        $validated = $organizationRequest->validated();

        // Check if image does exist
        $validated = $this->checkAndUploadLogo($organizationRequest, $validated);

        // Create new record
        $organization = Organization::create($validated);

        // Check if organization is created
        if (!$organization) {
            abort(400, 'Something is wrong...');
        }

        // Return organization
        return $this->jsonResponse([
            'message' => 'Organization is created.',
            'data' => $organization,
        ], 201);
    }

    /**
     * Summary of getAllOrganizations: A public function that gets all organizations.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllOrganizations(Request $request)
    {

        // Define the number of items per page (default to 15)
        $perPage = (int) $request->input('perPage', 15);


        // Query organizations
        $query = Organization::query()->orderBy('created_at', 'desc');

        // Paginate the results
        $organizations = $query->paginate($perPage);

        // Return resources
        return OrganizationResource::collection($organizations);
    }
}
