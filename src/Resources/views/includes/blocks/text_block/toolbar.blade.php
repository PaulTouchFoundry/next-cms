<div id="toolbar" class="toolbar">
    <ul class="list list--inline">
        @unless (in_array($page->page_type, [ 'article', 'campaign', 'product' ]))
        <li><a href="#" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1"><span class="icon fa fa-header" title="Heading" aria-hidden="true"></span>1</a></li>
        @endunless
        @unless ($page->page_type === 'article')
        <li><a href="#" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4"><span class="icon fa fa-header" title="Heading" aria-hidden="true"></span>4</a></li>
        @endunless
        <li><a href="#" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6"><span class="icon fa fa-header" title="Heading" aria-hidden="true"></span>6</a></li>
        <li><a href="#" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p"><span class="icon fa fa-paragraph" title="Paragraph" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="bold"><span class="icon fa fa-bold" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="italic"><span class="icon fa fa-italic" title="Italic" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="underline"><span class="icon fa fa-underline" title="Underline" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="insertUnorderedList"><span class="icon fa fa-list-ul" title="List" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="createLink"><span class="icon fa fa-link" title="Link" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="removeLink"><span class="icon fa fa-unlink" title="Unlink" aria-hidden="true"></span></a></li>
        <li><a href="#" data-wysihtml5-command="undo"><span class="icon fa fa-undo" title="Undo" aria-hidden="true"></span></a></li>
    </ul>
    <div data-wysihtml5-dialog="createLink" class="toolbar__link" style="display: none">
        <div class="form">
            <label class="label" for="link">
                @lang('includes.toolbar.paste_link')
                <input type="text" class="input" data-wysihtml5-dialog-field="href" value="http://"/>
            </label>
            <div class="btn-group btn-group--left">
                <a data-wysihtml5-dialog-action="save" class="btn">@lang('includes.toolbar.controls.ok')</a>
                <a data-wysihtml5-dialog-action="cancel" class="btn btn--transparent">@lang('includes.toolbar.controls.cancel')</a>
            </div>
        </div>
    </div>
</div>
