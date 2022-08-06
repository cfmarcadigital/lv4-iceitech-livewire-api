<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class Products extends Component
{
    public $products, $name, $detail, $product_id;
    public $isOpen = 0;
    public $urlApi='http://v4-iceitech-livewire-api.local/api/products';

    public function render()
    {
        //$this->products = Product::all();
        
        $response = Http::get($this->urlApi);
        $this->products = $response->json();

        return view('livewire.products');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->detail = '';
        $this->product_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        /*Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'detail' => $this->detail
        ]);*/
        
        if($this->product_id){
            $response = Http::post($this->urlApi."/".$this->product_id,[
                'name' => $this->name,
                'detail' => $this->detail,
                '_method' => 'PUT'
            ]);
        } else {
            $response = Http::post($this->urlApi,[
                'name' => $this->name,
                'detail' => $this->detail
            ]);
        }

        session()->flash('message', 
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.');
        session()->flash('type', 
            $this->product_id ? 'teal' : 'green');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->detail = $product->detail;
    
        $this->openModal();
    }

    public function delete($id)
    {
        //Product::find($id)->delete();

        $response = Http::delete($this->urlApi."/".$this->product_id);

        session()->flash('message', 'Product Deleted Successfully.');
        session()->flash('type', 'red');
    }
}