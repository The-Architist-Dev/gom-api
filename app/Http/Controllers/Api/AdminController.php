<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prediction;
use App\Models\Payment;
use App\Models\CeramicLine;
use App\Services\AzureBlobStorageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private $azureStorage;
    
    public function __construct(AzureBlobStorageService $azureStorage)
    {
        $this->azureStorage = $azureStorage;
    }
    
    public function dashboard(): JsonResponse
    {
        $stats = [
            'total_users' => User::count(),
            'total_predictions' => Prediction::count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount_vnd'),
        ];

        $topUsers = User::withCount('predictions')
            ->orderByDesc('predictions_count')
            ->limit(10)
            ->get();

        return response()->json([
            'stats' => $stats,
            'top_users' => $topUsers
        ]);
    }

    public function users(Request $request): JsonResponse
    {
        $search = $request->query('search');
        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->latest()->get()
        ]);
    }

    public function updateUser(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['role', 'token_balance', 'free_predictions_used', 'name', 'email']));
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function deleteUser($id): JsonResponse
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete yourself'], 403);
        }
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'User deleted']);
    }

    public function ceramicLines(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => CeramicLine::orderByDesc('is_featured')->orderBy('name')->get()
        ]);
    }

    public function storeCeramicLine(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'origin' => 'nullable|string',
            'country' => 'nullable|string',
            'era' => 'nullable|string',
            'description' => 'nullable|string',
            'style' => 'nullable|string',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Upload image to Azure if provided
        if ($request->hasFile('image')) {
            try {
                $data['image_url'] = $this->azureStorage->uploadSingleFile($request->file('image'), 'ceramic-lines');
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Lỗi upload image: ' . $e->getMessage()], 500);
            }
        }

        unset($data['image']); // Remove file object from data
        $line = CeramicLine::create($data);
        return response()->json(['status' => 'success', 'data' => $line]);
    }

    public function updateCeramicLine(Request $request, $id): JsonResponse
    {
        $line = CeramicLine::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'nullable|string',
            'origin' => 'nullable|string',
            'country' => 'nullable|string',
            'era' => 'nullable|string',
            'description' => 'nullable|string',
            'style' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        // Upload new image to Azure if provided
        if ($request->hasFile('image')) {
            try {
                $data['image_url'] = $this->azureStorage->uploadSingleFile($request->file('image'), 'ceramic-lines');
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Lỗi upload image: ' . $e->getMessage()], 500);
            }
        }
        
        unset($data['image']); // Remove file object from data
        $line->update($data);
        return response()->json(['status' => 'success', 'data' => $line->fresh()]);
    }

    public function deleteCeramicLine($id): JsonResponse
    {
        $line = CeramicLine::findOrFail($id);
        $line->delete();
        return response()->json(['status' => 'success', 'message' => 'Ceramic line deleted']);
    }

    public function payments(): JsonResponse
    {
        $payments = Payment::with('user')->latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $payments
        ]);
    }

    public function predictions(): JsonResponse
    {
        $preds = Prediction::with('user')->latest()->limit(100)->get();
        return response()->json([
            'status' => 'success',
            'data' => $preds
        ]);
    }
}
