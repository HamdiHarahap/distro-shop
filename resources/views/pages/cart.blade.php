<x-layout title="Keranjang Belanja">
    <section class="px-10 pt-28 py-20">
        <h1 class="text-3xl font-bold mb-6 text-center">Keranjang Belanja Kamu</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (count($cart) > 0)
            <div class="flex flex-col gap-6">
                @foreach ($cart as $key => $item)
                    <div class="flex items-center justify-between border rounded-lg p-4 shadow-sm">
                        <div class="flex items-center gap-6">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-24 h-24 object-cover rounded-md" alt="">
                            <div>
                                <h2 class="font-bold text-xl">{{ $item['name'] }}</h2>
                                <p class="text-zinc-500">Ukuran: {{ $item['size'] }}</p>
                                <p class="text-zinc-500">Jumlah: {{ $item['quantity'] }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="font-semibold text-lg">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                            <form action="{{ route('cart.remove', $key) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-between items-center mt-8 border-t pt-4">
                    <h2 class="font-bold text-2xl">Total:</h2>
                    <h2 class="font-bold text-2xl text-green-600">
                        Rp {{ number_format(collect($cart)->sum(function($item) {
                            return $item['price'] * $item['quantity'];
                        }), 0, ',', '.') }}
                    </h2>
                </div>

                <div class="flex justify-end">
                    <button 
                        type="button"
                        onclick="openModal()"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold"
                    >
                        Checkout Sekarang
                    </button>
                </div>
            </div>
        @else
            <div class="text-center mt-20">
                <p class="text-zinc-500 text-lg mb-6">Keranjang kamu masih kosong!</p>
                <a href="/products" class="text-blue-500 font-semibold hover:underline">Belanja Sekarang</a>
            </div>
        @endif
    </section>

    <script>
        function openModal() {
            document.getElementById('checkoutModal').classList.remove('hidden');
            document.getElementById('checkoutModal').classList.add('flex');
        }
    
        function closeModal() {
            document.getElementById('checkoutModal').classList.add('hidden');
            document.getElementById('checkoutModal').classList.remove('flex');
        }
    
        function toggleProofField() {
            const cod = document.querySelector('input[value="cod"]').checked;
            const proofField = document.getElementById('proofField');
    
            if (cod) {
                proofField.classList.add('hidden');
            } else {
                proofField.classList.remove('hidden');
            }
        }
    </script>
    
    
</x-layout>

<div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full relative overflow-y-auto max-h-screen">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

        <h2 class="text-2xl font-bold mb-6 text-center">Checkout Pesanan Kamu</h2>

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <h3 class="text-lg font-semibold mb-2">Barang Dipesan:</h3>
                @foreach ($cart as $item)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Ukuran: {{ $item['size'] }} | Jumlah: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-semibold">
                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <p class="text-lg font-bold">Total</p>
                    <p class="text-lg font-bold text-green-600">
                        Rp {{ number_format(collect($cart)->sum(function($item) {
                            return $item['price'] * $item['quantity'];
                        }), 0, ',', '.') }}
                    </p>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="alamat" class="font-medium">Alamat Kirim</label>
                    <textarea type="text" id="alamat" name="alamat" class="px-3 py-2 rounded-md border"></textarea>
                </div>
            </div>
            <div class="space-y-3">
                <h3 class="text-lg font-semibold mb-2">Metode Pembayaran:</h3>

                <label class="flex items-center gap-2">
                    <input type="radio" name="payment_method" value="cod" required onchange="toggleProofField()" class="accent-green-500">
                    <span>Bayar di Tempat (COD)</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="payment_method" value="bni" required onchange="toggleProofField()" class="accent-green-500">
                    <span>Transfer Bank BNI (1234567890 AN: DistroShop)</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="payment_method" value="bri" required onchange="toggleProofField()" class="accent-green-500">
                    <span>Transfer Bank BRI (1234567890 AN: DistroShop)</span>
                </label>
            </div>
            <div id="proofField" class="hidden">
                <h3 class="text-lg font-semibold mb-2 mt-4">Upload Bukti Pembayaran:</h3>
                <input type="file" name="payment_proof" accept="image/*" class="border p-2 rounded w-full">
                <p class="text-sm text-gray-400 mt-1">*Hanya wajib jika pilih Transfer Bank</p>
            </div>
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold">
                    Konfirmasi Checkout
                </button>
            </div>
        </form>
    </div>
</div>
