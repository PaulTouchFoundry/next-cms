@extends('cms::layouts.default-header')

@section('title')
@lang('cms::doc.view.title')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::doclink.view.header')</h3>
        <div class="header-actions">

        </div>
    </div>

    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif

    <div class="l-section">
        @foreach ($pageProducts as $product)
            @include('cms::includes.doc-link', $product)
        @endforeach
    </div>
</div>
@stop

@section('afterJS')
<script>
(function() {
    /* ==========================================================================
     * Resumable
     * ========================================================================== */

    var uploadButton = function (_target, $btn, uid, token) {
        var query = { 'token': token, 'uid': uid, '_token': '{{ csrf_token() }}' };
        var r = new Resumable({
            target: _target,
            query: query,
            maxFiles: 1,
            simultaneousUploads: 1
        });
        // console.log($btn);
        r.assignBrowse($btn[0]);
        r.on('fileAdded', function(file) {
            $('.js-resumable-message').remove();
            $('input.js-resumable').attr('disabled', 'disabled');
            $btn.parent().append('<p class="js-resumable-progress js-resumable-message"></p>');
            r.upload();
        });
        r.on('fileError', function(file, e) {
            $('.js-resumable-message').remove();
            $('input.js-resumable').removeAttr('disabled');
            var $message = $('<div class="alert alert--warning js-resumable-message" style="margin-top: 1em;margin-bottom: 1em;" role="alert"></div>');
            $message.append($('<div class="alert__title">Warning</div>'));
            if (e === 'Overwrite?') {
                var $overwrite = $('<a class="alert__link" href="#">Overwite File</a>');
                $overwrite.click(function() {
                    query.overwrite = 1;
                    r.updateQuery(query);
                    file.retry();
                });
                $message.append($('<p class="alert__message">File name already exists. </p>').append($overwrite));
            } else {
                $message.append($('<p class="alert__message"></p>').text(e));
                r.cancel();
            }
            $btn.parent().append($message);
        });
        r.on('fileSuccess', function(file) {
            $('.js-resumable-message').remove();
            $('input.js-resumable').removeAttr('disabled');
            $btn.parent().append('<div class="alert alert--success" style="margin-top: 1em;margin-bottom: 1em;" role="alert"><div class="alert__title">Success</div><p class="alert__message">File Uploaded</p></div>');
            $btn.remove();
            r.cancel();
            location.reload();
        });
        r.on('progress', function(file) {
            $('input.js-resumable').removeAttr('disabled');
            $('.js-resumable-progress').text('Uploading progress: '+Math.round(r.progress()*100)+'%');
        });
    };

    var $resumable = $('.js-resumable');
    var $pageProducts = {!!$pageProducts!!};

    if ($resumable.length > 0) {
        $resumable.each(function (ix, ob) {
            var target = $(ob).data('target');
            var id = $pageProducts[ix].id;
            var token = $(ob).data('token');

            uploadButton(target, $('#product-'+id), id, token);
        });
    }
})();
</script>
@stop
