<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryResource;
use App\Models\Merchandise;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    /**
     * Summary of queryInventory: A private function that queries inventory.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function queryInventory() {

        // Return query
        return Merchandise::with(['organization', 'category', 'images']);

    }

    /**
     * Summary of getAllInventoriesByOrganization: A public function that gets all inventories by organization ID
     * @param \Illuminate\Http\Request $request
     * @param string $organization_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllInventoriesByOrganization(Request $request, String $organization_id) {
        // Define the number of items per page (default to 15)
        $perPage = (int) $request->input('perPage', 15);

        // Get and sanitize the search term
        $searchTerm = $this->sanitizeAndGet($request);

        /**
         * - Query merchandise with organization by Organization ID
         */
        $query = $this->queryInventory()->where('organization_id', $organization_id);

        // Apply the search filter if search term is provided
        if (!empty($searchTerm)) {
            $query->where('name', 'LIKE', '%' . strtolower($searchTerm) . '%');
        }

        // Paginate the results
        $inventories = $query->paginate($perPage);

        // Return resources
        return InventoryResource::collection($inventories);
    }

    /**
     * Summary of findInventory: A public function that finds an inventory by ID.
     * @param string $id
     * @return Merchandise|null
     */
    public function findInventory(String $id) {

        // Find inventory by ID
        $inventory = $this->queryInventory()->find($id);

        // Return inventory
        return $inventory;

    }
}
