<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $query = Review::with(['user:id,name', 'product:id,name'])->latest();

        $status = $request->query('status');
        if ($status === 'pending') {
            $query->where('status', Review::STATUS_PENDING); 
        } elseif ($status === 'approved') {
            $query->where('status', Review::STATUS_APPROVED); 
        } elseif ($status === 'rejected') {
             $query->where('status', Review::STATUS_REJECTED); 
        }

        $reviews = $query->paginate(20)->withQueryString();

         $allStatuses = [
             'pending' => 'Chờ duyệt (' . Review::where('status', Review::STATUS_PENDING)->count() . ')', 
             'approved' => 'Đã duyệt',
             'rejected' => 'Bị từ chối', 
         ];

         return view('admin.reviews.index', compact('reviews', 'status', 'allStatuses'));
        }

    public function approve(Review $review): RedirectResponse
    {
        try {
            $review->status = Review::STATUS_APPROVED;
            $review->save();
            return redirect()->back()->with('success', 'Đã duyệt đánh giá thành công.');
        } catch (\Exception $e) { /* ... log error ... */ }
    }

    public function destroy(Review $review): RedirectResponse
    {
         try {
             $review->delete();
             return redirect()->back()->with('success', 'Xóa đánh giá thành công.');
         } catch (\Exception $e) {
             Log::error("Error deleting review ID {$review->id}: " . $e->getMessage());
             return redirect()->back()->with('error', 'Lỗi khi xóa đánh giá.');
         }
    }

    public function reject(Review $review): RedirectResponse 
    {
        Log::info("Admin User " . auth()->id() . " rejecting Review ID: {$review->id}");
        try {
            if ($review->status == Review::STATUS_PENDING) {
                $review->status = Review::STATUS_REJECTED;
                $review->save();
                return redirect()->back()->with('success', 'Đã từ chối đánh giá.');
            } else {
                return redirect()->back()->with('info', 'Đánh giá này không ở trạng thái chờ duyệt để từ chối.');
            }

        } catch (\Exception $e) {
             Log::error("Error rejecting review ID {$review->id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi khi từ chối đánh giá.');
        }
    }
}