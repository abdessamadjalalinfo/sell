<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->nom = $request->nom;
        $product->prix = $request->prix;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->save();


        if ($request->hasfile('filenames')) {
            $images = Image::all()->where('product_id', $request->id);
            foreach ($images as $img) {
                $img->delete();
            }

            foreach ($request->file('filenames') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path(), $name);
                $file = new Image();
                $file->path = $name;
                $file->product_id = $product->id;
                $file->save();
            }
        }


        return redirect()->back();
    }
    public function delete($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->back();
    }
    public function add(Request $request)
    {
        $product = new Product();
        $product->nom = $request->nom;
        $product->prix = $request->prix;
        $product->stock = $request->stock;
        $product->categorie = $request->categories;
        $product->description = $request->description;
        $product->save();

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path(), $name);
                $file = new Image();
                $file->path = $name;
                $file->product_id = $product->id;
                $file->save();
            }
        }


        return redirect()->back();
    }
}
