@extends('layouts.app')

@section('content')
<div class="bg-pink-50 min-h-screen">
    <!-- Hero Banner -->
    <div class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center mb-4 mt-20" style="font-family: BebasNeue;">ČASTÉ DOTAZY</h1>
           
        </div>
    </div>

        <!-- FAQ Categories -->
        <div class="flex flex-wrap justify-center mt-6 mb-10 gap-4">
            <button class="category-btn active px-6 py-2 rounded-full bg-pink-400 text-black font-bold transition-all"
                    style="font-family: Nunito;" data-category="all">
                Všechny
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all"
                    style="font-family: Nunito;" data-category="orders">
                Objednávky
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all"
                    style="font-family: Nunito;" data-category="shipping">
                Doprava
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all"
                    style="font-family: Nunito;" data-category="returns">
                Reklamace
            </button>
            <button class="category-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-bold transition-all"
                    style="font-family: Nunito;" data-category="contact">
                Kontakt
            </button>
        </div>



        <!-- FAQs -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                @php
                    $faqs = [
                        [
                            'question' => 'Jak dlouho trvá zpracování mé žádosti?',
                            'answer' => 'Zpracování žádosti obvykle trvá 1-2 pracovní dny. Budeme vás informovat e-mailem.',
                            'category' => 'orders',
                          
                        ],
                        [
                            'question' => 'Jak mohu kontaktovat podporu?',
                            'answer' => 'Podporu můžete kontaktovat prostřednictvím našeho e-mailu <strong>support@support.cz</strong> nebo telefonicky na čísle <strong>123 456 789</strong>. Jsme k dispozici každý pracovní den od 9:00 do 17:00.',
                            'category' => 'contact',
                          
                        ],
                        [
                            'question' => 'Nabízíte vrácení peněz?',
                            'answer' => 'Ano, nabízíme vrácení peněz do 30 dnů od zakoupení, pokud nejste s produktem spokojeni. Produkt musí být v původním stavu a v originálním balení. Pro zahájení procesu vrácení peněz nás kontaktujte e-mailem.',
                            'category' => 'returns',
                            
                        ],
                        [
                            'question' => 'Kdy mi bude doručeno objednané zboží?',
                            'answer' => 'Zboží dorazí většinou do 24 hodin od potvrzení odeslání zboží. Zboží, které je skladem předáváme dopravci obvykle do 24 hodin během pracovních dnů. O každém kroku zpracování vaší objednávky vás budeme informovat e-mailem.',
                            'category' => 'shipping',
                           
                        ],
                        [
                            'question' => 'Zasíláte i na Slovensko?',
                            'answer' => 'Ano. Pokud nepřesáhne internetová objednávka nad 3 000 Kč bez DPH (200 EUR), bude připočítán manipulační poplatek (poštovné) podle platného ceníku PPL, který je součástí obchodních podmínek. Doručení na Slovensko obvykle trvá 2-3 pracovní dny.',
                            'category' => 'shipping',
                            
                        ],
                        [
                            'question' => 'Jak mohu reklamovat zboží?',
                            'answer' => 'Reklamační řízení může být zahájeno, jestliže zákazník předloží kompletní reklamové zboží, prokáže nákup reklamovaného zboží dokladem o nákupu (prodejkou, fakturou) a doloží vyplněný reklamační list. Reklamaci můžete podat osobně na naší prodejně nebo zaslat poštou s přiloženým reklamačním listem.',
                            'category' => 'returns',
                            
                        ],
                        [
                            'question' => 'Jaké platební metody přijímáte?',
                            'answer' => 'Přijímáme platby kartou (Visa, Mastercard), bankovním převodem, dobírkou a online platebními metodami jako je Apple Pay, Google Pay a PayPal. Všechny online platby jsou zabezpečené a šifrované.',
                            'category' => 'orders',
                            
                        ],
                        [
                            'question' => 'Mohu změnit nebo zrušit svou objednávku?',
                            'answer' => 'Objednávku můžete změnit nebo zrušit do 1 hodiny od jejího odeslání. Kontaktujte nás co nejdříve e-mailem nebo telefonicky. Pokud již byla objednávka zpracována, nemusí být možné ji změnit nebo zrušit.',
                            'category' => 'orders',
                           
                        ],
                    ];
                @endphp

                <div class="divide-y divide-gray-200">
                    @foreach ($faqs as $index => $faq)
                        <div class="faq-item" data-category="{{ $faq['category'] }}">
                            <button class="w-full text-left px-6 py-4 focus:outline-none transition-colors hover:bg-gray-50 flex items-center justify-between"
                                    onclick="toggleFaq({{ $index }})">
                                <div class="flex items-center">
                                    <span class="text-lg font-semibold" style="font-family: Nunito;">{{ $faq['question'] }}</span>
                                </div>
                            </button>
                            <div class="faq-answer overflow-hidden max-h-0 transition-all duration-300 ease-in-out bg-gray-50">
                                <div class="p-6 border-t border-gray-100">
                                    <p class="text-gray-700" style="font-family: NunitoLight;">{!! $faq['answer'] !!}</p>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

           

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle Function
    window.toggleFaq = function(index) {
        const allAnswers = document.querySelectorAll('.faq-answer');
        const allIcons = document.querySelectorAll('.faq-icon');
        const currentAnswer = allAnswers[index];
        const currentIcon = allIcons[index];

        // Check if this FAQ is already open
        const isOpen = currentAnswer.classList.contains('active');

        // Close all FAQs
        allAnswers.forEach(answer => {
            answer.style.maxHeight = '0px';
            answer.classList.remove('active');
        });

        allIcons.forEach(icon => {
            icon.classList.remove('rotate-45');
        });

        // If the clicked FAQ wasn't open, open it
        if (!isOpen) {
            currentAnswer.style.maxHeight = currentAnswer.scrollHeight + 'px';
            currentAnswer.classList.add('active');
            currentIcon.classList.add('rotate-45');
        }
    };

    // Category Filter
    const categoryButtons = document.querySelectorAll('.category-btn');
    const faqItems = document.querySelectorAll('.faq-item');

    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            categoryButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-pink-400', 'text-black');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });

            button.classList.add('active', 'bg-pink-400', 'text-black');
            button.classList.remove('bg-gray-200', 'text-gray-700');

            const category = button.getAttribute('data-category');

            // Show/hide FAQ items based on category
            faqItems.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });

    // Search functionality
    const searchInput = document.getElementById('faq-search');

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();

        faqItems.forEach(item => {
            const question = item.querySelector('button span').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();

            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });

        // Reset category buttons
        categoryButtons.forEach(btn => {
            btn.classList.remove('active', 'bg-pink-400', 'text-black');
            btn.classList.add('bg-gray-200', 'text-gray-700');
        });

        // Set "All" as active
        categoryButtons[0].classList.add('active', 'bg-pink-400', 'text-black');
        categoryButtons[0].classList.remove('bg-gray-200', 'text-gray-700');
    });
});
</script>

<style>
/* Smooth transitions for FAQ answers */
.faq-answer {
    transition: max-height 0.5s ease, opacity 0.3s ease;
}

/* Category button active state */
.category-btn.active {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Hover effect for FAQ items */
.faq-item button:hover {
    background-color: #FEFAF0;
}
</style>
@endsection
