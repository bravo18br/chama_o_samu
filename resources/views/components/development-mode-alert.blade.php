@env('local')
    <div class="cartao" style="color: white; font-size: 12px; position: fixed; top: 5px; right: 5px; z-index: 1000; background: rgba(0, 0, 0, 0.6); padding: 5px; border-radius: 5px;">
        <p>MODO DE DESENVOLVIMENTO</p>
        <p class="d-block d-sm-none">TELA XS (max-width: 575px)</p>
        <p class="d-none d-sm-block d-md-none">TELA SM (576px~767px)</p>
        <p class="d-none d-md-block d-lg-none">TELA MD (768px~991px)</p>
        <p class="d-none d-lg-block d-xl-none">TELA LG (992px~1199px)</p>
        <p class="d-none d-xl-block d-xxl-none">TELA XL (1200px~1399px)</p>
        <p class="d-none d-xxl-block">TELA XXL (min-width: 1400px)</p>
    </div>
    @endenv
