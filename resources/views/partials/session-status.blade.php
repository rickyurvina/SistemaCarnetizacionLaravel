@if(session()->has('success'))
<div class="alert alert-success alert-dismissible " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>{{session('success')}}</strong>
</div>
@elseif(session()->has('delete'))
    <div class="alert alert-warning alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{session('delete')}}</strong>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-error alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{session('error')}}</strong>
    </div>
@endif

