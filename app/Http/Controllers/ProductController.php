<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Show all the products
    public function index() {
        return view('products.index', [
            'products' => Product::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }
 
    // Show single product
    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return view('products.show', ['product' => $product]);
        } else {
            abort(404);
        }
    }

 
 

     public function create() {
        return view('products.create');
     }





    // Store Create Form Data
    public function store(Request $request)
    {
        // Validate the Data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('products', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required',
            'tags' => 'required',
        ]);

        // Upload an image
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        /** @var \App\Models\User|null $user */
        $user = Auth::user(); // safer for IDEs
        $formFields['user_id'] = $user ? $user->id : null;

        // Save to the database
        Product::create($formFields);

        Session::flash('message', 'Product Created Successfully!');
        return redirect('/');
    }

    // Show Edit Form
    public function edit(Product $product){
        return view('products/edit', ['product' => $product]);
    }



    // Update Edit Form
    public function update(Request $request, Product $product)
    {
        /** @var \App\Models\User|null $user */
        
        $user = Auth::user();

        // Ensure logged-in user owns this product

        if (!$user || $product->user_id !== $user->id) {
            abort(403, 'Unauthorized Action');
        }

        // Validate Data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required',
            'tags' => 'required',
        ]);

        // Upload new image (optional)
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $product->update($formFields);

        return redirect('/')->with('message', 'Product Updated Successfully!');
    }


















    // Delete Product
    public function destroy(Product $product) 
    {
        /** @var \App\Models\User|null $user */

        $user = Auth::user();

        if (!$user || $product->user_id !== $user->id) {
            abort(403, 'Unauthorized Action');
        }

        $product->delete();
        return redirect('/')->with('message', 'Product Deleted Successfully');
    }














    
    
    // Manage Products
    public function manage()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $products = $user ? $user->products()->get() : collect();

        return view('products.manage', ['products' => $products]);
    }
}
