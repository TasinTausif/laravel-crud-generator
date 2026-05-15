<?php
namespace App\Http\Controllers;
use App\Models\Foods;
use App\Http\Requests\FoodsRequest;
class FoodsController extends Controller
{
    public function index()
    {
        $foods = Foods::all();
        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        return view('foods.create');
    }

    public function store(FoodsRequest $request)
    {
        Foods::create($request->validated());
        return redirect()->route('foods.index');
    }

    public function show(Foods $foods)
    {
        return view('foods.show', compact('foods'));
    }

    public function edit(Foods $foods)
    {
        return view('foods.edit', compact('foods'));
    }

    public function update(FoodsRequest $request, Foods $foods)
    {
        $foods->update($request->validated());
        return redirect()->route('foods.index');
    }

    public function destroy(Foods $foods)
    {
        $foods->delete();
        return redirect()->route('foods.index');
    }
}