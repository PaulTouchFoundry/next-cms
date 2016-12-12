@foreach($errors->get('success') AS $success)
    <div class="alert alert--success js-alert" role="alert">
        <div class="alert__title">Success</div>
        <p class="alert__message">
            {!! $success !!}
        </p>
        <button class="alert__dismiss js-dismiss"><span class="icon fa fa-times" aria-hidden="true"></span></button>
    </div>
@endforeach

@foreach($errors->get('error') AS $error)
    <div class="alert alert--error js-alert" role="alert">
        <div class="alert__title">Error</div>
        <p class="alert__message">
            {!! $error !!}
        </p>
        <button class="alert__dismiss js-dismiss"><span class="icon fa fa-times" aria-hidden="true"></span></button>
    </div>
@endforeach

@foreach($errors->get('warning') AS $warning)
    <div class="alert alert--warning js-alert" role="alert">
        <div class="alert__title">Warning</div>
        <p class="alert__message">
            {!! $warning !!}
        </p>
        <button class="alert__dismiss js-dismiss"><span class="icon fa fa-times" aria-hidden="true"></span></button>
    </div>
@endforeach
