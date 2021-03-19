@if (session('flash_messages'))
    @php $messages = session('flash_messages') @endphp
    <div class="alert alert-{{ $messages['type'] }} alert-dismissible fade show" role="alert">
        {{ $messages['message'] }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="cil-x"></i></span></button>
    </div>
@endif
