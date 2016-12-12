<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mediamodal-label" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mediamodal-label">@lang('cms::media.modal_header')</h4>
                <button class="modal-close" type="button" data-dismiss="modal" aria-label="@lang('cms::controls.close')">
                    <span class="icon fa fa-times" aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="image-gallery">
                    <ul class="list list--inline">
                        @foreach (Wearenext\CMS\Models\Media::where('tag', $tag)->get() as $mediaEntry)
                            <li>
                                <a class="js-media-select" href="{{ $mediaEntry->getThumb() }}" data-dismiss="modal" data-media-id="{{ $mediaEntry->id }}" data-media-url="{{ $mediaEntry->getURL() }}">
                                    <img src="{{ $mediaEntry->getThumb() }}" width="500" alt="" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>