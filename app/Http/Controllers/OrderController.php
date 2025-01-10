<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Summary of getAllOrders: A public function that gets all orders.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllOrders(Request $request) {
        // Define the number of items per page (default to 25)
        $perPage = (int) $request->input('perPage', default: 25);

        // Get and sanitize the search term
        $searchTerm = $this->sanitizeAndGet($request);

        // Query orders
        $query = Order::with('user');

        // Apply the search filter if search term is provided
        if (!empty($searchTerm)) {
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', '%' . strtolower($searchTerm) . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . strtolower($searchTerm) . '%')
                    ->orWhere('last_name', 'LIKE', '%' . strtolower($searchTerm) . '%')
                    ->orWhere('email', 'LIKE', '%' . strtolower($searchTerm) . '%')
                    ->orWhere('username', 'LIKE', '%' . strtolower($searchTerm) . '%')
                    ->orWhere('student_id', 'LIKE', '%' . strtolower($searchTerm) . '%');
            });
        }

        // Sort by the latest (newest orders first)
        $query->orderBy('created_at', 'desc');

        // Paginate the results
        $orders = $query->paginate($perPage);

        // Return resources
        return OrderResource::collection($orders);

    }
}
