<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchandiseRequest;
use App\Http\Resources\InventoryResource;
use App\Models\Merchandise;
use App\Models\MerchandiseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MerchandiseController extends Controller
{

    // FileController controller
    private $fileController;
    // Inventory controller
    private $inventoryController;

    /**
     * MerchandiseController constructor
     */
    public function __construct(FileController $fileController, InventoryController $inventoryController)
    {
        $this->fileController = $fileController;
        $this->inventoryController = $inventoryController;
    }

    /**
     * Summary of deleteMerchandiseByID: A public function that deletes a merchandise by ID.
     * @param string $merchandise_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteMerchandiseByID(String $merchandise_id)
    {
        // Find the mercandise by ID
        $merchandise = Merchandise::findOrFail($merchandise_id);

        // Delete merchandise record
        $merchandise->delete();

        // Return record
        return $this->jsonResponse([
            'message' => 'The merchandise is deleted.',
        ], 200);
    }

    /**
     * Summary of addNewMerchandise: A public function that creates a new merchandise record.
     * @param \App\Http\Requests\MerchandiseRequest $merchandiseRequest
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function addNewMerchandise(MerchandiseRequest $merchandiseRequest)
    {

        // Get validated
        $validated = $merchandiseRequest->validated();

        // Create new record
        $merchandise = Merchandise::create($validated);

        // Check images
        if ($merchandiseRequest->input('images')) {

            foreach ($merchandiseRequest->file('images') as $index => $image) {

                // Convert 'isMain' to boolean (true/false)
                $isMain = filter_var($merchandiseRequest->input('images')[$index]['isMain'], FILTER_VALIDATE_BOOLEAN);

                // Upload the file using the FileController method
                $imageURL = $this->fileController->uploadImage($image, 'file', 'merchandises', 'public');

                // Create a merchandise image record
                MerchandiseImage::create([
                    'merchandise_id' => $merchandise->id,
                    'isMain' => $isMain,
                    'image_url' => $imageURL,
                ]);
            }
        }

        // Return record
        return $this->jsonResponse([
            'message' => 'Merchandise created.',
            'data' => new InventoryResource($this->inventoryController->findInventory($merchandise->id))
        ], 201);
    }

    /**
     * Summary of editMerchandiseByID: A public function that updates the merchandise record by ID.
     * @param \App\Http\Requests\MerchandiseRequest $merchandiseRequest
     * @param string $merchandise_id
     * @return void
     */
    public function editMerchandiseByID(MerchandiseRequest $merchandiseRequest, String $merchandise_id)
    {
        // Get validated
        $validated = $merchandiseRequest->validated();

        // Find the mercandise by ID
        $merchandise = Merchandise::findOrFail($merchandise_id);

        // Update the merchandise
        $merchandise->updated($validated);

        // Return record
        return $this->jsonResponse([
            'message' => 'The merchandise is updated.',
            'data' => $merchandise
        ], 200);
    }
}
