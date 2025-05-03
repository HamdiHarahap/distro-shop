<x-layout title="Halaman Produk">
    <section class="px-28 pt-28 pb-24">
        <h1 class="text-4xl font-semibold mb-6">Semua Baju</h1>
        <div class="grid grid-cols-4 gap-y-10">
            @foreach ($products as $item)
                <a href="/product/{{$item->id}}" class="flex flex-col gap-1">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="" class="w-[18rem] rounded-md">
                    <h3 class="font-semibold">{{$item->nama}}</h3>
                    <p class="font-bold text-lg">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    </section>
</x-layout>