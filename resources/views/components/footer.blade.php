<footer class="bg-[#f6f2eb] px-28 pt-20 pb-8 flex flex-col gap-16">
    <div class="flex justify-between w-full">
        <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold tracking-wider">DistroShop</h3>           
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold text-lg">Kontak Kami</h3>
            <div class="flex flex-col gap-1">
                <a class="flex items-center gap-3">
                    <img src="{{ asset('/assets/icons/whatsapp.svg') }}" alt="" class="w-6">
                    <p>+62 812 6036 6275</p>
                </a>
                <a class="flex items-center gap-3">
                    <img src="{{ asset('/assets/icons/gmail.svg') }}" alt="" class="w-6">
                    <p>distroshop@gmail.com</p>
                </a>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold text-lg">Links</h3>
            <ul>
                <li class="list-disc list-inside"><a href="" class="hover:text-gray-300">KEMEJA</a></li>
                <li class="list-disc list-inside"><a href="" class="hover:text-gray-300">KAOS</a></li>
                <li class="list-disc list-inside"><a href="" class="hover:text-gray-300">POLO </a></li>
            </ul>
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold text-lg">Ikuti Kami</h3>
            <div class="grid grid-cols-4 gap-3">
                <div class="border-2 rounded-full p-2 w-fit cursor-pointer hover:scale-110 hover:bg-gray-500 transition-all">
                    <img src="{{ asset('/assets/icons/instagram.svg') }}" alt="" class="w-4">
                </div>
                <div class="border-2 rounded-full p-2 w-fit cursor-pointer hover:scale-110 hover:bg-gray-500 transition-all">
                    <img src="{{ asset('/assets/icons/youtube.svg') }}" alt="" class="w-4">
                </div>
                <div class="border-2 rounded-full p-2 w-fit cursor-pointer hover:scale-110 hover:bg-gray-500 transition-all">
                    <img src="{{ asset('/assets/icons/tiktok.svg') }}" alt="" class="w-4">
                </div>
            </div>
        </div>
    </div>
    <h3 class="font-semibold text-lg text-center">&copy; 2025 DistroShop. All Rights Reserved</h3>
</footer>