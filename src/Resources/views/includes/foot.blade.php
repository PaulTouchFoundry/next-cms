<!-- JavaScript -->

<script src="{{ url('/vendor/cms/js/vendor/jquery.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/jquery.are-you-sure.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/wysihtml5-toolbar.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/wysihtml5-rules.js') }}"></script>
<script src="{{ url('/vendor/cms/js/plugins.js') }}"></script>
<script src="{{ url('/vendor/cms/js/main.js') }}"></script>
<script src="{{ url('/vendor/cms/js/text.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js') }}"></script>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.5.1/pikaday.min.js') }}"></script>
<script type="text/javascript">
    var picker = new Pikaday({
        field: $('#custom_date')[0],
        format: 'YYYY-MM-DD'
    });
</script>

<script>UTIL.init();</script>

@unless (is_null(config('googleanalytics.id')))
<!-- Google Analytics: change UA-XXXXX-X to be your site’s ID -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','{{ config('googleanalytics.id') }}','auto');ga('send','pageview');
</script>
@endunless
