<div class="card is-published">
    <div class="card-inner">
        <a class="card__link" href="{{ route('cms.doc.view', compact('id')) }}" target="_blank">
            <h3 class="card__title">{{ $name }}</h3>
            <p class="card__synopsis"></p>
            <time class="card__time" datetime="{{ $modified->format('Y-m-d') }}">@lang('cms::messages.last_updated', [ 'date' => $modified->format('j F Y, H:i') ])</time>
        </a>
        {!! Form::open(['action' => 'DocsController@addDocumentToPage']) !!}
        {{-- @foreach($pageDocuments as $pageDocument) --}}
        <label>
            {{ $pageDocument->page_name }}
            {!! Form::checkbox('retirement-annuity', 'value', true) !!}
        </label>
        {!! Form::close() !!}
        <a class="btn btn--bordered btn--small" href="{{ route('cms.doc.delete', compact('id', 'hash')) }}" role="button">@lang('cms::controls.delete')</a>
    </div>
</div>
