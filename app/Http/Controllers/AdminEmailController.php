<?php

  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Models\UserModel;
  use App\Mail\UserMessage;
  use Illuminate\Support\Facades\Mail;
  use Illuminate\Support\Facades\Storage;

  class AdminEmailController extends Controller
  {
      public function create()
      {
          $users = UserModel::select('user_id', 'username', 'email')->get();
          return view('dashboard.admin.email.send-email', compact('users'));
      }

      public function send(Request $request)
      {
          $request->validate([
              'user_id' => 'required|exists:user,user_id',
              'message' => 'required|string|max:1000',
              'attachment' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
          ]);

          try {
              $user = UserModel::findOrFail($request->user_id);
              $filePath = null;
              $fileName = null;

              if ($request->hasFile('attachment')) {
                  $file = $request->file('attachment');
                  $fileName = time() . '_' . $file->getClientOriginalName();
                  $filePath = $file->storeAs('email_attachments', $fileName, 'public');
                  $absolutePath = Storage::disk('public')->path($filePath);
                  if (!file_exists($absolutePath)) {
                      \Log::error('File not found after upload: ' . $absolutePath);
                      throw new \Exception('Failed to save attachment.');
                  }
                  $filePath = $absolutePath;
              }

              Mail::to($user->email)->send(new UserMessage(
                  $user,
                  $request->message,
                  $filePath,
                  $fileName
              ));

              return redirect()->back()->with('success', 'Email sent successfully to ' . $user->username);
          } catch (\Exception $e) {
              \Log::error('Email sending failed: ' . $e->getMessage());
              return redirect()->back()->with('error', 'Failed to send email. Please try again.');
          }
      }
  }