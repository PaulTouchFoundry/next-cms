(function() {

    var $inputs = $('.js-wysihtml5');

    var rules = {
        tags: {
            h1: {},
            h2: {},
            h4: {},
            h6: {},
            strong: {},
            b:      {},
            i:      {},
            u:      {},
            em:     {},
            br:     {},
            p:      {},
            div:    {},
            span:   {},
            ul:     {},
            ol:     {},
            li:     {},
            a:      {
                set_attributes: {
                    target: "_blank"
                },
                check_attributes: {
                    href:   "url" // important to avoid XSS
                }
            }
        }
    };

    $inputs.each(function (i, el) {
        var ed = new wysihtml5.Editor(el, {
            toolbar: 'toolbar',
            parserRules: rules,
            classNameCommandActive: 'active',
            useLineBreaks: false,
        });

        ed.on('change', function(foo) {
            $(el).val(ed.getValue());
        });

        ed.on('save:dialog', function(foo) {
            $(el).val(ed.getValue());
        });
        $('.js-editortoggle').click(function() {
            if ($('.wysihtml5-sandbox').length > 0) {
                //ed.destroy();
                $('.wysihtml5-sandbox').remove();
                $('.toolbar').remove();
                $(el).show();
                $(this).remove();
            }
        });
    });
}());
