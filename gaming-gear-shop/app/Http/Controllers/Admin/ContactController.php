<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ContactReplyMail;      
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    
    public function index(Request $request): View
    {
        $query = Contact::latest('created_at'); 

        $status = $request->query('status');
        if ($status && in_array($status, [Contact::STATUS_NEW, Contact::STATUS_REPLIED, Contact::STATUS_CLOSED])) {
            $query->where('status', $status);
        }

        $contacts = $query->paginate(15)->withQueryString();
        $allStatuses = [ 
            Contact::STATUS_NEW => 'Mới',
            Contact::STATUS_REPLIED => 'Đã phản hồi',
            Contact::STATUS_CLOSED => 'Đã đóng',
        ];

        return view('admin.contacts.index', compact('contacts', 'allStatuses', 'status'));
    }

  
    public function replyForm(Contact $contact): View 
    {
        return view('admin.contacts.reply', compact('contact'));
    }

   
    public function sendReply(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'reply_subject' => 'required|string|max:255',
            'reply_message' => 'required|string|max:5000',
        ]);

        $replySubject = $validated['reply_subject'];
        $replyMessage = $validated['reply_message'];

        try {
             Log::info("Queueing Contact Reply email for Contact ID {$contact->id} to {$contact->email}.");
             Mail::to($contact->email)->send(new ContactReplyMail($contact, $replySubject, $replyMessage));
             
            $contact->status = Contact::STATUS_REPLIED;
            $contact->replied_at = now();
            $contact->replied_by_user_id = auth()->id(); 
            $contact->save();

            Log::info("Contact Reply email for Contact ID {$contact->id} queued successfully.");
            return redirect()->route('contacts.index')->with('success', 'Đã gửi phản hồi thành công!');

        } catch (\Exception $e) {
             Log::error("Failed to queue Contact Reply email for Contact ID {$contact->id}: " . $e->getMessage());
             return redirect()->back()->withInput()->with('error', 'Gửi phản hồi thất bại: ' . $e->getMessage());
        }
    }

  
    public function destroy(Contact $contact): RedirectResponse
    {
         try {
             $contact->delete();
             return redirect()->route('contacts.index')->with('success', 'Xóa liên hệ thành công!');
         } catch (\Exception $e) {
             Log::error("Error deleting contact ID {$contact->id}: " . $e->getMessage());
             return redirect()->route('contacts.index')->with('error', 'Đã xảy ra lỗi khi xóa liên hệ.');
         }
    }
}