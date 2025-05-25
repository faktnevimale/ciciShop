<!-- resources/views/components/why-choose-us.blade.php -->

<section class="py-16 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-gray-900 mb-4">Proč nakupovat u nás?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Rychlá Doprava --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                        <x-heroicon-o-truck class="h-10 w-10 text-blue-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rychlá Doprava</h3>
                    <p class="text-gray-600 text-center">Rychlou dopravu máme, dokud nám neproletí kapotou ojnice. Obvykle do druhého dne je zboží u Vás.</p>
                </div>

            </div>

            {{-- Autorizovaní prodejci --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                        <x-heroicon-o-academic-cap class="h-10 w-10 text-blue-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Autorizovaní prodejci</h3>
                    <p class="text-gray-600 text-center">Jsme partneři se značkami BMW a Subaru. Vyšší cena Vás bude odrazovat, ale víme, že Vašeho miláčka nenecháte stát na cihlách.</p>
                </div>

            </div>

            {{-- Zákaznická Podpora --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                        <x-heroicon-o-chat-bubble-bottom-center class="h-10 w-10 text-blue-500" />
                    </div>
                    <h3 class="text-xl font-bold mb-3">Zákaznická Podpora</h3>
                    <p class="text-gray-600 text-center">Za naší podporu nemusíte platit, jako u BMW. Jsme tady pro Vás pořád. Poradíme, vysvětlíme a klidně Vám poskytneme i rameno na vyplakání.</p>
                </div>

            </div>
        </div>
    </div>
</section>
