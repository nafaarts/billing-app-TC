<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AttachmentController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        if ($request->hasFile('attachmentFile')) {
            try {
                $file = $request->file('attachmentFile');
                $filename = $file->getClientOriginalName();
                $request->file('attachmentFile')->move('attachment/' . $invoice->invoice_no, $filename);

                $data = [
                    'invoice_id' => $invoice->id,
                    'attachment_name' => $filename,
                    'attachment_type' => $file->getClientMimeType(),
                    'attachment_folder' => $invoice->invoice_no,
                    'uploaded_by' => auth()->user()->id,
                ];
                return response()->json(
                    ['status' => 'success', 'data' => Attachment::create($data)],
                    200
                );
            } catch (\Throwable $th) {
                return response(['status' => 'failed', 'data' => $th], 500);
            }
        }
    }

    public function destroy(Attachment $attachment)
    {
        // dd($attachment->invoice);
        File::delete('attachment/' . $attachment->invoice->invoice_no . '/' . $attachment->attachment_name);
        $attachment->delete();

        return redirect('invoice/' . $attachment->invoice->invoice_no . '/detail')->with('status', 'Attachment has been deleted!');
    }
}
