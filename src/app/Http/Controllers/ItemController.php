<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ItemController extends Controller
{
   public function index(Request $request)
{
    $tab = $request->query('tab');
    $keyword = $request->query('keyword');

    if ($tab === 'mylist') {
        if (!Auth::check()) {
            $items = collect();

            return view('items.index', compact('items', 'tab', 'keyword'));
        }

        $items = Item::whereHas('likes', function ($query) {
            $query->where('user_id', Auth::id());
        });
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

public function show($item_id)
{
    $item = Item::with([
        'user',
        'likes',
        'comments.user',
        'categories',
        'purchase',
    ])->findOrFail($item_id);

    $isLiked = false;

    if (Auth::check()) {
        $isLiked = Like::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->exists();
    }

    return view('items.show', compact('item', 'isLiked'));
}

public function comment(CommentRequest $request, $item_id)
{
    Comment::create([
        'user_id' => Auth::id(),
        'item_id' => $item_id,
        'comment' => $request->comment,
    ]);

    return redirect('/item/' . $item_id);
}

public function create()
{
    $categories = Category::all();

    return view('items.sell', compact('categories'));
}

public function like($item_id)
{
    $like = Like::where('user_id', Auth::id())
        ->where('item_id', $item_id)
        ->first();

    if ($like) {
        $like->delete();
    } else {
        Like::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
        ]);
    }

    return redirect('/item/' . $item_id);
}

public function store(Request $request)
{
    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('items', 'public');
    }

    $item = Item::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'brand' => $request->brand,
        'description' => $request->description,
        'price' => $request->price,
        'condition' => $request->condition,
        'image' => $imagePath ? 'storage/' . $imagePath : null,
    ]);

    $item->categories()->attach($request->categories);

    return redirect('/');
}
}
