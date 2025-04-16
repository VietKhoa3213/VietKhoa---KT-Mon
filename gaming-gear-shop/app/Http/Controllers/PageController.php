<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest; 
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{

    public function showContactForm(): View
    {
        $user = auth()->user();
        return view('contact.create', compact('user'));
    }

   
    public function storeContactForm(StoreContactRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['status'] = Contact::STATUS_NEW;

        try {
            Contact::create($validatedData);

            return redirect()->route('contact.create')
                             ->with('success', 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        } catch (\Exception $e) {
             \Illuminate\Support\Facades\Log::error('Error saving contact form: ' . $e->getMessage());
             return redirect()->back()
                            ->withInput()
                            ->with('error', 'Đã có lỗi xảy ra khi gửi liên hệ. Vui lòng thử lại.');
        }
    }
}
