<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin/admin');
    }

    public function showCreateManagerForm()
    {
        $restaurants = Restaurant::all();
        return view('admin.create-manager', compact('restaurants'));
    }

    public function createManager(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'manager',
        ]);

        $restaurantId = $request->input('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant) {
            $restaurant->manager_id = $user->id;
            $restaurant->save();
        }

        return redirect()->route('admin.done');
    }

    public function done()
    {
        return view('admin.done-admin');
    }

    public function showSendEmailForm()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.send-email', compact('users'));
    }

    public function sendEmail(Request $request)
    {
        $recipientsIds = $request->input('recipients');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $recipients = User::whereIn('id', $recipientsIds)->get();

        foreach ($recipients as $recipient) {
            Mail::raw($message, function ($mail) use ($recipient, $subject) {
                $mail->to($recipient->email)
                    ->subject($subject);
            });
        }

        return redirect()->route('admin.sent');
    }

    public function sent()
    {
        return view('admin.sent');
    }
}

