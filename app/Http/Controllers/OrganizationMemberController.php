<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationMemberResource;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{

    /**
     * Summary of getMemberByID: A public function that gets the member by ID.
     * @param string $organization_id
     * @param string $member_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getMemberByID(String $organization_id, String $member_id)
    {
        // Retrieve the organization by its ID
        $organization = Organization::find($organization_id);
    
        // Check if the organization exists
        if (!$organization) {
            return $this->jsonResponse(['error' => 'Organization not found'], 404);
        }
    
        // Retrieve the member (user) by member_id where they belong to the given organization
        $member = $organization->users()->where('users.id', $member_id)->first();
    
        // Check if the member exists in the organization
        if (!$member) {
            return $this->jsonResponse(['error' => 'Member not found in this organization'], 404);
        }
    
        // Return the member's data
        return $this->jsonResponse(new OrganizationMemberResource($member), 200);
    }
    

    /**
     * Summary of getMembersByStatus: A public function that gets the members base on their status.
     * @param string $organization_id
     * @param string $status
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getMembersByStatus(Request $request, String $organization_id)
    {
        // Define the number of items per page (default to 15)
        $perPage = (int) $request->input('perPage', 15);

        // Define the status (default to pending)
        $status = (string) $request->input('status', 'pending');
        // Define the search
        $searchTerm = (string) $request->input('searchTerm', '');

        // Find organization by ID
        $organization = Organization::findOrFail($organization_id);

        // Fetch users with the given status and paginate
        $members = $organization->users()
            ->wherePivot('status', $status)
            ->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', "%{$searchTerm}%")
                    ->orWhere('middle_name', 'like', "%{$searchTerm}%")
                    ->orWhere('last_name', 'like', "%{$searchTerm}%")
                    ->orWhereHas('course', function ($courseQuery) use ($searchTerm) {
                        $courseQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            })
            ->with('course') // Make sure to include the course relation if needed
            ->paginate($perPage);

        // Return the list of members with first name, last name, and course name
        return OrganizationMemberResource::collection($members);
    }
}
