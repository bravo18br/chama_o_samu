import geo from './geolocalizacao.js'

await app()

async function app() {
    // if ('serviceWorker' in navigator) {
    //     window.addEventListener('load', () => {
    //         navigator.serviceWorker.register('/storage/js/service-worker.js')
    //             .then(registration => {
    //                 console.log('Service Worker registrado com sucesso:', registration);
    //             })
    //             .catch(error => {
    //                 console.error('Falha ao registrar o Service Worker:', error);
    //             });
    //     });
    // }

    const userDataString = document.querySelector('meta[name="userData"]').getAttribute("content")
    const userData = JSON.parse(userDataString)
    monitorarSituacao()
    ampliaFoto()

    if (userData.analfabeto === 1) {
        const legenda_user_lista = document.querySelectorAll('.legenda_user')
        if (legenda_user_lista) {
            for (const legenda of legenda_user_lista) {
                legenda.classList.add('d-none')
            }
        }
    }
    if (window.location.pathname === '/') {
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('botaoInstalarPWA').style.display = 'block';
        });
        document.getElementById('botaoInstalarPWA').addEventListener('click', (e) => {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    document.getElementById('botaoInstalarPWA').style.display = 'none';
                    console.log('User accepted the install prompt');
                }
                deferredPrompt = null;
            });
        });
    }
    if (window.location.pathname === '/dashboard') {
        const div_raiz = document.getElementById('id_raiz')
        const botao_enviar = document.getElementById('botao_enviar')
        if (botao_enviar) {
            div_raiz.addEventListener('click', function (event) {
                botao_enviar.click()
            })
        }
    }
    if (window.location.pathname === '/chamado') {
        const id_cancelar = document.getElementById('id_cancelar')
        id_cancelar.addEventListener('click', function (event) {
            window.location.href = '/dashboard'
        })
        const div_cartoes = document.querySelectorAll('.nivel1')
        const botao_enviar = document.getElementById('botao_enviar')
        for (const cartao of div_cartoes) {
            cartao.addEventListener('click', function (event) {
                event.stopPropagation();
                botao_enviar.click()
            })
        }
    }
    if (window.location.pathname === '/nivel1') {
        const id_cancelar = document.getElementById('id_cancelar')
        id_cancelar.addEventListener('click', function (event) {
            window.location.href = '/dashboard'
        })
        const div_cartoes = document.querySelectorAll('.nivel2')
        const botao_enviar = document.getElementById('botao_enviar')
        for (const cartao of div_cartoes) {
            cartao.addEventListener('click', function (event) {
                event.stopPropagation();
                botao_enviar.click()
            })
        }
    }
    if (window.location.pathname === '/nivel2') {
        const id_cancelar = document.getElementById('id_cancelar')
        id_cancelar.addEventListener('click', function (event) {
            window.location.href = '/dashboard'
        })
        const id_avancar = document.getElementById('id_avancar')
        id_avancar.addEventListener('click', function (event) {
            document.getElementById('formulario').submit()
        })
    }
    if (window.location.pathname === '/nivel3') {
        const id_cancelar = document.getElementById('id_cancelar')
        id_cancelar.addEventListener('click', function (event) {
            window.location.href = '/dashboard'
        })
        const id_registrar = document.getElementById('id_registrar')
        id_registrar.addEventListener('click', async function (event) {
            const [latitude, longitude] = await geo.geolocalizacao()
            document.querySelector('input[name="latitude"]').value = latitude
            document.querySelector('input[name="longitude"]').value = longitude

            const endereco = await geo.geolocalizacaoReversa(latitude, longitude);
            document.querySelector('input[name="geolocalizacao"]').value = endereco;

            document.getElementById('formulario').submit()
        })
        const id_foto = document.getElementById('id_foto')
        id_foto.addEventListener('click', function (event) {
            if (event.target['id'] === 'cartao_27') {
                event.preventDefault()
                const fileInput = document.querySelector('input[name="fotos[]"]')
                fileInput.click()
            }
        })
    }

    if (window.location.pathname === '/monitoramento') {
        const chamado_id = document.getElementById('chamado_id');
        if (chamado_id) {
            const id = chamado_id.getAttribute('data-id');
            geo.exibirMapa(id);
            monitorarReload();
        }
    }

    if (window.location.pathname === '/historico') {
        const modal_lista = document.querySelectorAll('.modal')
        for (const modal of modal_lista) {
            modal.addEventListener('shown.bs.modal', function (event) {
                const id = event.target.getAttribute('chamado_id')
                geo.exibirMapa(id);
            });
        }
        await timer(60);
        window.location.reload();
    }
    if (window.location.pathname === '/operacao') {
        const modal_lista = document.querySelectorAll('.modal');
        for (const modal of modal_lista) {
            modal.addEventListener('shown.bs.modal', function (event) {
                const id = event.target.getAttribute('chamado_id');
                geo.exibirMapa(id);

                const id_select_situacao = document.getElementById('id_select_situacao_' + id)
                const id_textarea_anotacao = document.getElementById('id_textarea_anotacao_' + id)
                const id_input_anotacao = document.getElementById('id_input_anotacao_' + id)
                const id_botao_anotacao = document.getElementById('id_botao_anotacao_' + id)

                id_select_situacao.addEventListener('change', function () {
                    let situacaoSelecionada = this.value;
                    atualizaChamado('situacao', situacaoSelecionada, id);
                    let resultado_switch = "";
                    switch (situacaoSelecionada) {
                        case '1':
                            resultado_switch = "aberto";
                            break;
                        case '2':
                            resultado_switch = "em andamento";
                            break;
                        case '3':
                            resultado_switch = "encerrado";
                            break;
                        case '4':
                            resultado_switch = "cancelado";
                            break;
                        default:
                            resultado_switch = "inválido";
                            break;
                    }
                    id_input_anotacao.value = `Mudou situação para ${resultado_switch}`;
                    id_botao_anotacao.click();
                });
                id_input_anotacao.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        id_botao_anotacao.click();
                    }
                });

                id_botao_anotacao.addEventListener('click', function (event) {
                    const conteudoDigitado = id_input_anotacao.value;
                    if (conteudoDigitado.trim() !== '') {
                        const dataHoraAtual = new Date().toLocaleString('pt-BR');
                        const registro = `${dataHoraAtual} - Operador ${userData.name}: ${conteudoDigitado}`;
                        id_textarea_anotacao.classList.add('d-flex');
                        id_textarea_anotacao.classList.remove('d-none');
                        id_textarea_anotacao.textContent += registro + '\n';
                        atualizaChamado('anotacao', registro, id);
                    }
                    id_input_anotacao.value = '';
                });

                modal.addEventListener('hidden.bs.modal', function () {
                    location.reload()
                });

                function atualizaChamado(campo, data, chamado) {
                    let dados = {};
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    dados[campo] = data;
                    dados['chamado'] = chamado;
                    fetch('/chamado', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify(dados)
                    });
                }
                window.addEventListener('beforeunload', function (event) {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const visita_id = this.document.getElementById('visita_id').value;

                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', '/encerra_visita', true);

                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log('Visita encerrada com sucesso.');
                            } else {
                                console.error('Erro ao encerrar visita:', xhr.status);
                            }
                        }
                    };
                    xhr.send(JSON.stringify({ id: visita_id }));
                });

            });
        }
    }

    function ampliaFoto() {
        const fotoChamado_lista = document.querySelectorAll('.fotoChamado');
        if (fotoChamado_lista) {
            fotoChamado_lista.forEach(fotoChamado => {
                fotoChamado.addEventListener('click', function () {
                    let imgFull = document.createElement('img');
                    imgFull.src = fotoChamado.src;
                    imgFull.style.width = '100%';
                    imgFull.style.height = '100%';
                    imgFull.style.position = 'fixed';
                    imgFull.style.top = '0';
                    imgFull.style.left = '0';
                    imgFull.style.zIndex = '9999';
                    imgFull.style.cursor = 'zoom-out';
                    document.body.appendChild(imgFull);
                    imgFull.addEventListener('click', function () {
                        document.body.removeChild(imgFull);
                    });
                });
            });
        }
    }

    async function monitorarReload() {
        while (window.location.pathname === '/monitoramento') {
            const elementoParagrafo = document.getElementById('id_chamado_situacao');
            const valorSituacao = elementoParagrafo.getAttribute('value');
            const situcao = parseInt(valorSituacao)
            if (situcao === 1 || situcao === 2) {
                await timer(60);
                window.location.reload();
            }
            await timer(60);
        }
    }

    async function monitorarSituacao() {
        while (true) {
            const elementoParagrafo = document.getElementById('id_chamado_situacao');
            const id_menu_solicitar_samu = document.getElementById('id_menu_solicitar_samu');
            if (elementoParagrafo && id_menu_solicitar_samu) {
                const valorSituacao = elementoParagrafo.getAttribute('value');
                const situacao = parseInt(valorSituacao);
                if (situacao === 1 || situacao === 2) {
                    id_menu_solicitar_samu.classList.add('d-none');
                } else {
                    id_menu_solicitar_samu.classList.remove('d-none');
                    id_menu_solicitar_samu.classList.add('hidden', 'space-x-8', 'sm:-my-px', 'sm:ms-10', 'sm:flex');
                }
            }
            await timer(10);
        }
    }

    async function timer(segundos) {
        await new Promise(resolve => setTimeout(resolve, segundos * 1000))
    }
}