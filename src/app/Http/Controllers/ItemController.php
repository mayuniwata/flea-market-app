<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $keyword = $request->query('keyword');

        if ($tab === 'mylist') {
            if (!Auth::check()) {
                $items = collect();
            } else {
                $items = Item::whereHas('likes', function ($query) {
                    $query->where('user_id', Auth::id());
                });
            }
        } else {
            $items = Item::query();

            if (Auth::check()) {
                $items->where('user_id', '!=', Auth::id());
            }
        }

        if (!empty($keyword)) {
            $items->where('name', 'like', '%' . $keyword . '%');
        }

        $items = $items->with('purchase')->get();

        return view('items.index', compact('items', 'tab', 'keyword'));
    }
}