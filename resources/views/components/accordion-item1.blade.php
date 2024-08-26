<div>
    <!-- Accordion Item 1 -->
    <div class="border border-gray-300 rounded-lg">
        <button class="w-full text-center px-4 py-2 bg-gray-200 rounded-t-lg focus:outline-none" onclick="toggleAccordion('accordion-item-1')">
            <span class="font-medium">Table USERS</span>
        </button>
        <div id="accordion-item-1" class="hidden px-4 py-2 bg-white">
            @if (count($listas['users']) == 0)
            <p>Table vazia</p>
            @else
        </div>
    </div>
</div>
