<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cepInput = document.getElementById('cep');
        const ruaInput = document.getElementById('rua');
        const form = document.querySelector('form');

        cepInput.addEventListener('input', function () {
            const cep = cepInput.value.replace(/\D/g, '');

            if (cep.length === 8) {
                axios.get(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => {
                        if (response.data.erro) {
                            alert('CEP não encontrado.');
                            return;
                        }

                        const { logradouro, localidade, uf } = response.data;

                        // Preencher o campo de rua
                        ruaInput.value = logradouro;

                        // Verificar se a cidade é Araucária-PR
                        if (localidade.toLowerCase() !== 'araucária' || uf.toLowerCase() !== 'pr') {
                            alert('Essa aplicação é exclusiva para usuários da cidade de Araucária PR.');
                            form.reset();
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        alert('Não foi possível buscar o endereço. Tente novamente.');
                    });
            }
        });
    });
</script>
