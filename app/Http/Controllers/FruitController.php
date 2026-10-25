<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $query = Fruit::orderBy('id');

        if ($search !== '') {
            $query->where(
                'fruit_name',
                'like',
                '%' . $search . '%'
            );
        }

        $fruits = $query->get();

        return view(
            'fruits.index',
            compact('fruits', 'search')
        );
    }

    public function create()
    {
        return view('fruits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fruit_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        Fruit::create($validated);

        return redirect()
            ->route('fruits.index')
            ->with('success', 'Fruit added successfully.');
    }

    public function edit(Fruit $fruit)
    {
        return view('fruits.edit', compact('fruit'));
    }

    public function update(Request $request, Fruit $fruit)
    {
        $validated = $request->validate([
            'fruit_name' => 'required|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        $fruit->update($validated);

        return redirect()
            ->route('fruits.index')
            ->with('success', 'Fruit updated successfully.');
    }

    public function destroy(Fruit $fruit)
    {
        $fruit->delete();

        return redirect()
            ->route('fruits.index')
            ->with('success', 'Fruit deleted successfully.');
    }
}
