@if (session()->has('msg'))
    @if(session()->get('msg')['tipo']=='erro')
    <div class="alert alert-danger d-flex justify-content-center gap-3">
        <p>{{session()->get('msg')['texto']}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->get('msg')['tipo']=='sucesso')
    <div class="alert alert-success d-flex justify-content-center gap-3">
        <p>{{session()->get('msg')['texto']}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
@endif