<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Deporzap</a>
        

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">               
                @if ($parametros['usuario']['rol_id']==config('constantes.ROL.ADMINISTRADOR'))
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard/producto">Productos</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Finalizar venta</a>
                </li>
                @endif
        </div>
    </div>
</nav>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>