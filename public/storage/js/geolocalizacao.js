async function geolocalizacao() {
    try {
        return await obterGeolocalizacao();
    } catch (error) {
        return [-999, -999];
    }
}

function obterGeolocalizacao() {
    return new Promise((resolve, reject) => {
        if ("geolocation" in navigator) {
            const options = {
                timeout: 10000,
                enableHighAccuracy: true,
                maximumAge: 0
            };
            const successCallback = position => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                resolve([latitude, longitude]);
            };
            const errorCallback = error => {
                reject(error);
            };
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback, options);
        } else {
            reject(new Error("Geolocalização não suportada"));
        }
    });
}

function exibirMapa(id) {
    const div_map = document.getElementById('map' + id);
    div_map.classList.add('d-flex');
    div_map.classList.remove('d-none');
    const latitude = document.getElementById('id_latitude_value_' + id).getAttribute('value');
    const longitude = document.getElementById('id_longitude_value_' + id).getAttribute('value');
    
    if (latitude == '' || latitude == '-999' || longitude == '' || longitude == '-999') {
        div_map.classList.add('d-none');
        div_map.classList.remove('d-flex');
        return;
    }
    
    const geoloc = `${latitude},${longitude}`;
    var coords = geoloc.split(',').map(Number);
    
    // Verificar se o mapa já foi inicializado
    if (div_map._leaflet_id) {
        // Se o mapa já foi inicializado, ajustar a visualização
        var map = div_map._leaflet_map;
        map.setView(coords, 14);
        L.marker(coords).addTo(map);
    } else {
        // Se o mapa ainda não foi inicializado, inicializá-lo
        var map = L.map('map' + id).setView(coords, 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker(coords).addTo(map);
        
        // Guardar uma referência ao mapa no elemento div
        div_map._leaflet_map = map;
    }
}


async function geolocalizacaoReversa(latitude, longitude) {
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
        const data = await response.json();
        if (data.display_name) {
            return data.display_name;
        } else {
            return 'Coordenadas não encontradas';
        }
    } catch (error) {
        return 'Ocorreu um erro: ' + error.message;
    }
}

const geo = {
    exibirMapa,
    geolocalizacao,
    geolocalizacaoReversa
}

export default geo