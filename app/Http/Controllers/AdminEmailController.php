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
        $pendingRequests = CertificateRequest::with(['pendaftaran', 'pendaftaran.mahasiswa', 'pendaftaran.mahasiswa.user'])
            ->get()
            ->filter(function ($request) {
                return !is_null($request->pendaftaran)
                    && !is_null($request->pendaftaran->mahasiswa)
                    && !is_null($request->pendaftaran->mahasiswa->user)
                    && !is_null($request->pendaftaran->mahasiswa->user->email);
            });

        Log::info('Pending Requests Count: ' . $pendingRequests->count());

        return view('dashboard.admin.email.send-email', compact('pendingRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $certificateRequest = CertificateRequest::findOrFail($id);
        $certificateRequest->update([
            'status' => $request->status,
            'notes' => $request->input('notes', $certificateRequest->notes),
        ]);

        Log::info('Status updated', ['id' => $id, 'status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated to ' . $request->status);
    }

    public function send(Request $request)
    {
        $request->validate([
            'certificate_request_id' => 'required|exists:certificate_requests,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $certificateRequest = CertificateRequest::with('pendaftaran.mahasiswa.user')->findOrFail($request->certificate_request_id);
            $mahasiswa = $certificateRequest->pendaftaran->mahasiswa;
            $user = $mahasiswa->user;

            if (!$user || !$user->email) {
                Log::error('Email not found', ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'user' => $user]);
                return redirect()->back()->with('error', 'Email address not found for this student.');
            }

            if ($certificateRequest->status !== 'approved') {
                Log::warning('Invalid status for sending', ['status' => $certificateRequest->status, 'id' => $certificateRequest->id]);
                return redirect()->back()->with('error', 'Email can only be sent for approved requests.');
            }

            $filePath = null;
            $fileName = null;

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('certificates', $fileName, 'public');
                if (!Storage::disk('public')->exists($filePath)) {
                    Log::error('File not found after upload: ' . $filePath);
                    throw new \Exception('Failed to save attachment.');
                }
                $certificateRequest->update(['file_path' => $filePath]);
            }

            Mail::to($user->email)->send(new CertificateEmail(
                $mahasiswa->nama,
                $request->subject,
                $request->message,
                $filePath,
                $fileName
            ));

            Log::info('Certificate email sent', ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'request_id' => $certificateRequest->id, 'email' => $user->email]);

            return redirect()->back()->with('success', 'Email sent successfully to ' . $user->username);
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email. Please check the logs or try again.');
        }
    }
}