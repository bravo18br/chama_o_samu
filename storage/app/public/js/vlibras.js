// vlibras.js
function initializeVLibras() {
    // Remove existing VLibras elements to avoid duplication
    var existingElements = document.querySelectorAll('div[vw]');
    existingElements.forEach(function(element) {
        element.remove();
    });

    // Create new VLibras elements
    var vwDiv = document.createElement('div');
    vwDiv.setAttribute('vw', 'class');
    vwDiv.classList.add('enabled');

    var vwAccessButtonDiv = document.createElement('div');
    vwAccessButtonDiv.setAttribute('vw-access-button', 'class');
    vwAccessButtonDiv.classList.add('active');

    var vwPluginWrapperDiv = document.createElement('div');
    vwPluginWrapperDiv.setAttribute('vw-plugin-wrapper', 'class');

    var vwPluginTopWrapperDiv = document.createElement('div');
    vwPluginTopWrapperDiv.classList.add('vw-plugin-top-wrapper');

    // Append the elements
    vwPluginWrapperDiv.appendChild(vwPluginTopWrapperDiv);
    vwDiv.appendChild(vwAccessButtonDiv);
    vwDiv.appendChild(vwPluginWrapperDiv);

    document.body.appendChild(vwDiv);

    // Load VLibras script
    var script = document.createElement('script');
    script.src = "https://vlibras.gov.br/app/vlibras-plugin.js";
    script.onload = function () {
        if (window.VLibras && window.VLibras.Widget) {
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        } else {
            console.error("VLibras script is not loaded properly.");
        }
    };
    document.head.appendChild(script);
}

document.addEventListener("DOMContentLoaded", function () {
    initializeVLibras();
});

document.addEventListener('livewire:load', function () {
    initializeVLibras();
});

document.addEventListener('livewire:update', function () {
    initializeVLibras();
});

document.addEventListener('livewire:navigate', function () {
    initializeVLibras();
});
