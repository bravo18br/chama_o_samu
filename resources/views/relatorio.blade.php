<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-1 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
                <div class="card m-1 p-1" style="width:33%;">
                    <div>
                        <canvas id="canvasChamadosMes" aria-label="Chamados do mês" role="img"></canvas>
                    </div>
                    <div class="text-center">
                        Total de Chamados: {{$total_chamados_mes}}
                    </div>
                </div>
                <div class="card m-1 p-1" style="width:66%;">
                    <div>
                        <canvas id="canvasOperadores" aria-label="Operadores" role="img"></canvas>
                    </div>
                    <div class="text-center">
                        Total de Operadores: {{$total_operadores}}
                    </div>
                </div>
            </div>
            <div class="p-1 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
                <div class="card m-1 p-1" style="width:66%;">
                    <div>
                        <canvas id="canvasChamadosTempoMedio" aria-label="tempo médio de atendimento" role="img"></canvas>
                    </div>
                    <div class="text-center">
                        Tempo médio de Atendimento: {{ number_format($tempo_medio_chamado, 2) }} minutos
                    </div>
                </div>
                <div class="card m-1 p-1" style="width:33%;">
                    <div>
                        <canvas id="canvasUsuarios" aria-label="Usuarios" role="img"></canvas>
                    </div>
                    <div class="text-center">
                        Total de Usuários: {{$total_usuarios}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    var ctx = document.getElementById('canvasChamadosMes').getContext('2d');
    var chartData = <?php echo json_encode($grafico_chamados_mes); ?>;
    new Chart(ctx, chartData);
</script>
<script>
    var ctx = document.getElementById('canvasOperadores').getContext('2d');
    var chartData = <?php echo json_encode($grafico_operadores); ?>;
    new Chart(ctx, chartData);
</script>
<script>
    var ctx = document.getElementById('canvasUsuarios').getContext('2d');
    var chartData = <?php echo json_encode($grafico_usuarios); ?>;
    new Chart(ctx, chartData);
</script>
<script>
    var ctx = document.getElementById('canvasChamadosTempoMedio').getContext('2d');
    var chartData = <?php echo json_encode($grafico_tempo_chamado); ?>;
    new Chart(ctx, chartData);
</script>