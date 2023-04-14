<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\History;
use App\Models\Product;
use App\Models\ProductInformation;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(CreateRequest $request)
    {
        $credentials = $request->validated();
        $products = Product::paginate(12);

        if (isset($credentials['search'])) {
            $search = $credentials['search'];

            if (is_numeric($credentials['search'])) $products = Product::where('code', 'LIKE', "%{$search}%")->with('information')->get();
            else $products = Product::where('title', 'LIKE', "%{$search}%")->with('information')->get();

            return view('product', compact('products', 'search'));
        }

        return view('product', compact('products'));
    }

    public function create()
    {
    }

    public function store(StoreRequest $request)
    {
        $credentials = $request->validated();

        $imageName = time() . '.' . $credentials['image']->extension();

        $path = 'products/images';
        $credentials['image']->storeAs('public/' . $path, $imageName);

        $faker = Faker::create();

        do {
            $code = $faker->bothify('#####');
        } while (Product::where('code', $code)->first() !== null);

        $product = Product::create([
            'code' => $code,
            'title' => $credentials['title'],
        ]);

        $product->information()->create([
            'photo_path' => '/storage/' . $path . '/' . $imageName,
            'product_id' => $product->id
        ]);

        return back()->with('Success', 'Товар успешно добавлен');
    }

    public function show(Product $product)
    {
        $product->loadMissing([
            'information'
        ]);

        $history = History::where('product_id', $product->id)->orderBy('created_at', 'desc')->paginate(6);

        return view('productShow', compact('product', 'history'));
    }

    public function edit(string $id)
    {
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $credentials = $request->validated();

        $product->update([
            'title' => $credentials['title'],
        ]);

        return back()->with('Success', 'Данные успешно изменены');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete(substr($product->information->photo_path, 9));

        $product->delete();

        return redirect('/products?type=Table')->with('Success', 'Товар успешно удален');
    }
}
