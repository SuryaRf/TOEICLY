<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use App\Mail\CertificateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminEmailController extends Controller
{
    public function create()
    {
        $requests = CertificateRequest::with(['pendaftaran', 'pendaftaran.mahasiswa', 'pendaftaran.mahasiswa.user'])
            ->get()
            ->filter(function ($request) {
                return !is_null($request->pendaftaran)
                    && !is_null($request->pendaftaran->mahasiswa)
                    && !is_null($request->pendaftaran->mahasiswa->user)
                    && !is_null($request->pendaftaran->mahasiswa->user->email);
            });

        Log::info('Requests fetched for email', ['count' => $requests->count()]);
        return view('dashboard.admin.email.send-email', compact('requests'));
    }

    public function send(Request $request)
    {
        Log::info('Send email process started', ['request' => $request->all()]);
        $request->validate([
            'certificate_request_id' => 'required|exists:certificate_requests,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            $certificateRequest = CertificateRequest::with('pendaftaran.mahasiswa.user')->findOrFail($request->certificate_request_id);
            $mahasiswa = $certificateRequest->pendaftaran->mahasiswa;
            $user = $mahasiswa->user;

            if (!$user || !$user->email) {
                Log::error('Email not found', ['mahasiswa_id' => $mahasiswa->mahasiswa_id, 'user' => $user]);
                return redirect()->back()->with('error', 'Email address not found for this student.');
            }

            $filePath = null;
            $fileName = null;

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('certificates', $fileName, 'public');
                Log::info('File stored', ['path' => $filePath, 'name' => $fileName]);
                if (!Storage::disk('public')->exists($filePath)) {
                    Log::error('File not found after upload', ['path' => $filePath]);
                    throw new \Exception('Failed to save attachment.');
                }
            }

            Log::info('Sending email', ['to' => $user->email, 'subject' => $request->subject]);
            Mail::to($user->email)->send(new CertificateEmail(
                $mahasiswa->nama,
                $request->subject,
                $request->message,
                $filePath,
                $fileName
            ));

            Log::info('Email sent successfully', ['request_id' => $certificateRequest->id, 'email' => $user->email]);
            return redirect()->back()->with('success', 'Email sent successfully to ' . $mahasiswa->nama);
        } catch (\Exception $e) {
            Log::error('Email sending failed', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Failed to send email. Please check the logs or try again.');
        }
    }
}