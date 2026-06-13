<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 'sell');
        $user = Auth::user();

        if ($page === 'buy') {
            $items = Item::whereHas('purchase', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } else {
            $items = Item::where('user_id', $user->id)->get();
        }

        return view('mypage.index', compact('user', 'items', 'page'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('mypage.profile', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $imagePath = optional($user->profile)->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        $user->update([
            'name' => $request->name,
        ]);

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building,
                'image' => 'storage/' . $imagePath,
            ]
        );

        return redirect('/mypage');
    }
}