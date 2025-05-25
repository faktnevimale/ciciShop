<!-- resources/views/components/why-choose-us.blade.php -->

<section class="py-16 px-4 bg-pink-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-pink-400 mb-4" style="font-family: BebasNeue, sans-serif;">Proč nakupovat u nás?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Rychlá Doprava --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-pink-100 rounded-full mb-6">
                        <x-heroicon-o-truck class="h-10 w-10 text-pink-500" />
                    </div>
                    <h3 class="text-xl text-pink-300 font-bold mb-3">Rychlá Doprava</h3>
                    <p class="text-gray-600 text-center">Hello Kitty posílá balíčky fofrem – obvykle do druhého dne jsou u vás jako mávnutím kouzelné mašličky!</p>
                </div>

            </div>

            {{-- Autorizovaní prodejci --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-pink-100 rounded-full mb-6">
                        <x-heroicon-o-academic-cap class="h-10 w-10 text-pink-500" />
                    </div>
                    <h3 class="text-xl text-pink-300 font-bold mb-3">Originální produkty</h3>
                    <p class="text-gray-600 text-center">Nakupujete u nás bezpečně – jsme Hello Kitty schválení! U nás najdete jen originální produkty!</p>
                </div>

            </div>

            {{-- Zákaznická Podpora --}}
            <div class="group">
                <div class="flex flex-col items-center transition-all duration-300 ">
                    <div class="flex justify-center items-center w-20 h-20 bg-pink-100 rounded-full mb-6">
                        <x-heroicon-o-chat-bubble-bottom-center class="h-10 w-10 text-pink-500" />
                    </div>
                    <h3 class="text-xl text-pink-300 font-bold mb-3">Zákaznická Podpora</h3>
                    <p class="text-gray-600 text-center">Máte dotaz? Napište nám! Naše zákaznická podpora vám odpoví rychle a s láskou.</p>
                </div>

            </div>
        </div>
    </div>
</section>
