<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá.',
            'rating.integer' => 'Điểm đánh giá phải là số.',
            'rating.min' => 'Điểm đánh giá thấp nhất là 1 sao.',
            'rating.max' => 'Điểm đánh giá cao nhất là 5 sao.',
            'comment.required' => 'Vui lòng nhập nội dung bình luận.',
            'comment.max' => 'Bình luận không được vượt quá 1000 ký tự.',
        ]);

        $userId = Auth::id(); 

        $existingReview = Review::where('user_id', $userId)
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingReview) {
            
             return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.')->withInput();
        }

        try {
            Review::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'status' => Review::STATUS_PENDING, 
            ]);

            return redirect()->route('products.show', $product) 
                             ->with('review_success', 'Đánh giá của bạn đã được gửi và đang chờ duyệt. Xin cảm ơn!');

        } catch (\Exception $e) {
             Log::error("Error saving review for product {$product->id} by user {$userId}: " . $e->getMessage());
             return redirect()->back()->with('error', 'Đã xảy ra lỗi khi gửi đánh giá.')->withInput();
        }
    }
}