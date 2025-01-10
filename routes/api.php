<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurricularController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationMemberController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

// Version 1 API
Route::prefix('/v1')->group(function () {

    // Router Auth Prefix
    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
    });

    /**
     * Router Authentication
     * Middleware: Authenticate first before accessing these resources
     */
    Route::middleware(['auth:sanctum'])->group(function () {

        /**
         * Resource: Curriculars resources
         * Authorize: Admin
         */
        Route::prefix('/curriculars')->middleware('role:admin')->group(function () {
            // POST
            Route::post('/{curricular_id}/upload-logo', [CurricularController::class, 'uploadLogoByID']);

        });

        /**
         * Resource: Organization resources
         * Authorize: Admin
         */
        Route::prefix('/organizations')->middleware('role:admin,student')->group(function () {

            // POST
            Route::post('/{organization_id}/join', [OrganizationController::class, 'joinOrganizationByID'])->middleware('role:student');
            Route::post('/', [OrganizationController::class, 'addNewOrganization'])->middleware('role:admin');

            // PUT
            Route::post('/{organization_id}/upload-logo', [OrganizationController::class, 'uploadLogo'])->middleware('role:admin');
            Route::put('/{organization_id}/update-name', [OrganizationController::class, 'updateOrganizationNameByID'])->middleware('role:admin');
            // Route::put('/{organization_id}', [OrganizationController::class, 'updateOrganizationByID'])->middleware('role:admin');

            // GET
            Route::get('/{organization_id}', [OrganizationController::class, 'getOrganizationByID'])->middleware('role:admin');
            Route::get('/', [OrganizationController::class, 'getAllOrganizations'])->middleware('role:admin,student');

            // DELETE
            Route::delete('/{organization_id}', [OrganizationController::class, 'deleteOrganizationByID'])->middleware('role:admin');
        });

        /**
         * Resource: Organization Members
         * Authorize: Admin or Officer
         */
        Route::prefix('/organizations/{organization_id}/members')->middleware('role:admin,officer')->group(function () {

            // GET
            Route::get('/status', [OrganizationMemberController::class, 'getMembersByStatus'])->middleware('role:admin,officer');
            Route::get('/{member_id}', [OrganizationMemberController::class, 'getMemberByID'])->middleware('role:admin');

        });

         /**
         * Resource: Elections Resources
         * Authorize: Admin
         */
        Route::prefix('/{organization_id}/elections')->middleware('role:admin')->group(function () {

            // GET
            Route::get('/{election_id}/positions', [PositionController::class, 'getAllPositionsByElection']);
            Route::get('/{election_id}/candidates', [CandidateController::class, 'getAllCandidates']);

            // POST
            Route::post('/', [ElectionController::class, 'addNewElection']);

            // DELETE
            Route::delete('/{election_id}', [ElectionController::class, 'deleteElectionByID']);

        });

        /**
         * Resource: Inventory resources
         * Authorize: Admin
         */
        Route::prefix('/organizations/{organization_id}/inventories')->middleware('role:admin')->group(function () {

            // GET 
            Route::get('/', [InventoryController::class, 'getAllInventoriesByOrganization']);

        });

        /**
         * Resource: Merchandies resources
         * Authorize: Admin
         */
        Route::prefix('/merchandises')->middleware('role:admin')->group(function () {

            // POST
            Route::post('/', [MerchandiseController::class, 'addNewMerchandise']);

            // PUT
            Route::put('/{merchandise_id}', [MerchandiseController::class, 'editMerchandiseByID']);

            // DELETE
            Route::delete('/{merchandise_id}', [MerchandiseController::class, 'deleteMerchandiseByID']);

        });

        /**
         * Resource: Categories resources
         * Authorize: Admin
         */
        Route::prefix('/categories')->middleware('role:admin')->group(function () {
            // GET
            Route::get('/', [CategoryController::class, 'getAllCategories']);
        });

        /**
         * Resource: Orders resources
         * Authorize: Admin
         */
        Route::prefix('/orders')->middleware('role:admin')->group(function () {

            // GET
            Route::get('/', [OrderController::class, 'getAllOrders']);

        });

        /**
         * Resource: Candidates Resources
         * Authorize: Admin
         */
        Route::prefix('/candidates')->middleware('role:admin')->group(function () {

           // POST
           Route::post('/', [CandidateController::class, 'addNewCandidate']);

        });

        /**
         * Resource: Position Resources
         * Authorize: Admin
         */
        Route::prefix('/positions')->middleware('role:admin')->group(function () {
            
            // POST
            Route::post('/', [PositionController::class, 'addNewPosition']);

            // PUT
            Route::put('/{position_id}', [PositionController::class, 'updatePositionByID']);
            
            // DELETE
            Route::delete('/{position_id}', [PositionController::class, 'deletePositionByID']);

        });

    });

});