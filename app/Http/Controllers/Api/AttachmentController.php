<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'task_list_id' => 'required',
            'file' => 'required|file|max:10240',
        ]);

         $file = $request->file('file');


        $path = $file->store('attachments', 'public');
        $originalName = $file->getClientOriginalName();
        $attachment = Attachment::create([
            'task_list_id' => $request->task_list_id,
            'file_path' => $path,
            'name' => $originalName
        ]);

        return response()->json($attachment, 201);
    }

    public function destroy(Attachment $attachment)
    {
        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();

        return response()->json(null, 204);
    }
    public function getFiles($list)
    {
        return Attachment::where('task_list_id', $list)->get();
    }
}
