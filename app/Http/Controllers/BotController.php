<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index()
    {
        $fruits = Fruit::orderBy('fruit_name')->get();

        $fruitData = $fruits->map(function ($fruit) {
            return [
                'fruit_name' => $fruit->fruit_name,
                'price_per_kg' => (float) $fruit->price_per_kg,
            ];
        })->values();

        return view('bot', compact('fruitData'));
    }

    public function chat(Request $request)
    {
        $message = strtolower(
            trim((string) $request->input('message', ''))
        );

        $fruits = Fruit::all();

        foreach ($fruits as $fruit) {

            $fruitName = strtolower($fruit->fruit_name);

            // The reply is rendered as HTML by the chat page,
            // so the fruit name is escaped to stay safe.
            $safeName = e($fruit->fruit_name);

            if ($message === $fruitName) {

                return response()->json([
                    'reply' =>
                        '🍎 ' . $safeName . ' is available.<br>' .
                        '💰 Price: ₹' . $fruit->price_per_kg . ' / kg'
                ]);
            }

            if ($message === $fruitName . ' price') {

                return response()->json([
                    'reply' =>
                        '💰 ' . $safeName . ' price is ₹' .
                        $fruit->price_per_kg . ' / kg'
                ]);
            }
        }

        return response()->json([
            'reply' =>
                '❌ Sorry, that fruit is not available in our database.'
        ]);
    }
}
