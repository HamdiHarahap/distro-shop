<x-layout title="Beranda">
    
    <section class="py-24 px-28 min-h-screen bg-center bg-cover flex flex-col justify-center items-center gap-5" style="background-image: url('{{ asset('/assets/images/hero.png') }}')">  
        <div class="flex flex-col gap-3 text-center">
            <h1 class="text-4xl font-bold">Temukan Gaya Terbaikmu <br> di Sini!</h1>
            <p class="text-lg text-gray-600">Berbagai pilihan pakaian untuk segala suasana</p>
        </div>
        <a href="/products" class="bg-zinc-800 px-5 py-2 rounded-md text-white">Belanja Sekarang</a>
    </section>  
    <section class="py-10 px-28 flex flex-col">
        <h1 class="font-semibold text-3xl mb-8">Baju Baru</h1>

        <div class="grid grid-cols-4 gap-y-10">
            @foreach ($products as $item)
                <a href="/product/{{$item->id}}" class="flex flex-col gap-1">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="" class="w-[18rem] rounded-md lg:w-[15rem]">
                    <h3 class="font-semibold">{{$item->nama}}</h3>
                    <p class="font-bold text-lg">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
        <a href="/products" class="font-semibold border border-black rounded-xl px-5 py-2 mx-auto mt-10 hover:bg-gray-100">Lihat Semua</a>
    </section>
    <section class="px-28 py-16 flex justify-around items-center">
        <div class="flex flex-col gap-5 w-[30rem]">
            <h1 class="font-semibold text-5xl">Bersiaplah untuk Koleksi Berani kami yang baru!</h1>
            <p class="text-zinc-600">
                Memperkenalkan Koleksi Baru Kami yang Berani! Tingkatkan gaya Anda dengan desain yang berani dan pernyataan yang bersemangat. Jelajahi pola yang mencolok dan warna berani yang mendefinisikan ulang lemari pakaian Anda. Bersiaplah untuk merangkul yang luar biasa!
            </p>
            <a href="/products" class="px-6 py-3 rounded-lg bg-blue-950 text-white font-semibold w-fit">Lihat Koleksi</a>
        </div>
        <img src="{{ asset('/assets/images/new.jpg') }}" alt="" class="rounded-lg">
    </section>
</x-layout>