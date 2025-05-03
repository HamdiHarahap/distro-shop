<?php 
    $desk = $product->deskripsi ? $product->deskripsi : 'Tidak Ada Deskripsi'
?>
<x-layout title="{{$product->nama}}">
    <section class="px-28 pt-28 pb-24 flex flex-col">
        <div class="flex gap-3 mx-auto">
            <a href="/" class="font-semibold">Home</a>
            <p>></p>
            <p class="font-semibold text-zinc-500 cursor-pointer">{{$product->nama}}</p>
        </div>
        
        <div class="mt-8 flex justify-center gap-12 w-full items-start">
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="" class="w-[25rem] rounded-md">
            <div class="flex flex-col gap-4">
                <h1 class="font-semibold text-3xl">{{$product->nama}}</h1>
                <p class="font-bold text-lg">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p class="text-zinc-500">{{$desk}}</p>
                {{-- Stock --}}
                <div class="flex flex-col gap-2 mt-4">
                    <h2 class="font-semibold text-xl mb-2">Stock Tersedia:</h2>
                    @foreach ($product->stocks as $stock)
                    <?php 
                        $stockNow = $stock->stock == 0 ? 'Habis' : $stock->stock . ' pcs'
                    ?>
                        <div class="flex items-center justify-between border p-2 rounded">
                            <p class="font-medium">{{ $stock->size }}</p>
                            <p class="text-zinc-600">{{ $stockNow }}</p>
                        </div>
                    @endforeach
                </div>
                
                <form action="{{ route('cart.add') }}" method="POST" class="mt-4 flex flex-col gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->nama }}">
                    <input type="hidden" name="price" value="{{ $product->harga }}">
                    <input type="hidden" name="image" value="{{ $product->gambar }}">
                
                    <label for="size">Pilih Ukuran:</label>
                    <select name="size" required class="border p-2 rounded">
                        @foreach ($product->stocks as $stock)
                            @if($stock->stock > 0)
                                <option value="{{ $stock->size }}">{{ $stock->size }}</option>
                            @endif
                        @endforeach
                    </select>
                
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                        Add to Cart
                    </button>
                </form>
                
            </div>
        </div>
    </section>
</x-layout>