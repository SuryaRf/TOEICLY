<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;
use App\Mail\CertificateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminEmailController extends Controller
{
public function create()
{
    $pendingRequests = CertificateRequest::whereIn('status', ['approved', 'pending']) // Include both approved and pending
        ->whereNull('file_path')
        ->with(['pendaftaran', 'pendaftaran.mahasiswa', 'pendaftaran.mahasiswa.user'])
        ->get()
        ->filter(function ($request) {
            return !is_null($request->pendaftaran)
                && !is_null($request->pendaftaran->mahasiswa)
                && !is_null($request->pendaftaran->mahasiswa->user)
                && !is_null($request->pendaftaran->mahasiswa->user->email);
        });

    Log::info('Pending Requests Count: ' . $pendingRequests->count());

    return view('dashboard.admin.send_email', compact('pendingRequests'));
}


    public function send(Request $request)
    {
        $request->validate([
            'certificate_request_id' => 'required|exists:certificate_requests,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'required|file|mimes:pdf|max:2048',
        ]);

        $certificateRequest = CertificateRequest::with('pendaftaran.mahasiswa.user')->findOrFail($request->certificate_request_id);
        if ($certificateRequest->status !== 'approved' || !is_null($certificateRequest->file_path)) {
            return redirect()->back()->with('error', 'Invalid certificate request status or file already uploaded.');
        }

        $mahasiswa = $certificateRequest->pendaftaran->mahasiswa;
        $user = $mahasiswa->user;
        if (!$user || !$user->email) {
            Log::error('Email not found', ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'user' => $user]);
            return redirect()->back()->with('error', 'Email address not found for this student.');
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filePath = 'certificates/' . time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->put($filePath, file_get_contents($file->getRealPath()));
            $certificateRequest->update(['file_path' => $filePath]);
        }

        Mail::to($user->email)->send(new CertificateEmail($mahasiswa->nama, $request->subject, $request->message, $filePath));

        Log::info('Certificate email sent', ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'request_id' => $certificateRequest->id, 'email' => $user->email]);

        return redirect()->route('admin.send_email')->with('success', 'Email sent successfully with certificate.');
    }
}
