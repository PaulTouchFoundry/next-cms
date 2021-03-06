<div class="card is-published">
    <div class="card-inner">
        <div class="card__link">
            <h3 class="card__title">{{ $product->page_name }}</h3>
            <p class="card__synopsis">
                @if ($product->document)
                    {{ $product->document->file_name }}
                @endif
            </p>
            <time class="card__time" datetime="{{ $product->updated_at->format('Y-m-d') }}">@lang('cms::messages.last_updated', [ 'date' => $product->updated_at->format('j F Y, H:i') ])</time>
        </div>
        @if ($product->document)
            <a class="btn btn--bordered btn--small second-card-btn" href="{{ route('cms.doc.delete', [$product->document_id, $product->document->hash]) }}" role="button">@lang('cms::controls.delete_document')</a>
        @endif
        @can('cms.doc_create')
            <button id="{{ 'product-'.$product->id }}" class="btn btn--icon js-resumable" type="button" data-field="{{ $uploadField }}" data-token="{{ $product->token }}" data-product-id="{{ $product->id }}" data-target="{{ route('cms.doc.upload') }}"><span class="icon icon--left fa fa-plus" title="Add" aria-hidden="true"></span> @lang('cms::doc.controls.create')</button>
            <input name="doc_upload" type="hidden" value="">
        @endcan
    </div>
</div>

<style type="text/css">
    .second-card-btn {
        top: 5.2em !important;
    }
</style>