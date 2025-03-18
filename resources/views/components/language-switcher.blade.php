<!-- resources/views/components/language-switcher.blade.php -->
<div class="relative">
    <button id="language-dropdown-button" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
        @if(App::getLocale() == 'en')
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#f0f0f0" d="M0 85.33h512v341.337H0z"/>
                    <path fill="#d80027" d="M0 85.33h512v113.775H0z"/>
                    <path fill="#0052b4" d="M0 312.884h512v113.775H0z"/>
                </svg>
                En
            </span>
        @else
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#f0f0f0" d="M0 85.337h512v341.326H0z"/>
                    <path fill="#a2001d" d="M0 85.337h512v170.663H0z"/>
                </svg>
                ID
            </span>
        @endif
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div id="language-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
        <div class="py-1">
            <a href="{{ route('language.switch', 'en') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#f0f0f0" d="M0 85.33h512v341.337H0z"/>
                    <path fill="#d80027" d="M0 85.33h512v113.775H0z"/>
                    <path fill="#0052b4" d="M0 312.884h512v113.775H0z"/>
                </svg>
                English
            </a>
            <a href="{{ route('language.switch', 'id') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#f0f0f0" d="M0 85.337h512v341.326H0z"/>
                    <path fill="#a2001d" d="M0 85.337h512v170.663H0z"/>
                </svg>
                Indonesia
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('language-dropdown-button');
        const menu = document.getElementById('language-dropdown-menu');

        button.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
