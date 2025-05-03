
<header class="navbar px-28 py-5 fixed w-full z-40 transition ease-in bg-white border-b-2 border-gray-200">
    <nav class="flex items-center justify-between">
        <a href="/" class="text-2xl font-bold tracking-wider">DistroShop</a>
        <ul class="flex gap-5 font-semibold mr-auto ml-16">
            <li><a href="/products/kemeja">KEMEJA</a></li>
            <li><a href="/products/kaos">KAOS</a></li>
            <li><a href="/products/polo">POLO</a></li>
        </ul>
        <div class="flex gap-6"> 
            <a href="/keranjang">
                <img src="{{ asset('/assets/icons/cart.svg') }}" alt="" class="w-6">
            </a>
            <div class="relative">
                <img src="{{ asset('/assets/icons/user.svg') }}" alt="" class="w-6 user-btn cursor-pointer">
                <div class="bg-gray-200 px-6 py-3 hidden flex-col gap-1 rounded-md absolute -bottom-20 user-modal -left-20">
                    <a href="/logout" class="text-red-500 font-semibold">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>