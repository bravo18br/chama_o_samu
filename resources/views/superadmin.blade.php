<x-app-layout>
    <!-- <div class="w-full mx-auto"> -->
    <div>
        <div class="relative top-12">
            <x-accordion-item1 id="accordion-item1" title="Accordion Item 1"></x-accordion-item1>
            <x-accordion-item2 id="accordion-item2" title="Accordion Item 2"></x-accordion-item2>
            <x-accordion-item3 id="accordion-item3" title="Accordion Item 3"></x-accordion-item3>
        </div>
    </div>

    <script>
        function toggleAccordion(id) {
            const element = document.getElementById(id);
            element.classList.toggle('hidden');
        }
    </script>

    @if(session('showModal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalId = `{{ session('showModal') }}`;
            var myModal = new bootstrap.Modal(document.getElementById(modalId), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
    @endif

    <x-busca-via-c-e-p />
</x-app-layout>
