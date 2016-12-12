<!-- JavaScript -->

<script src="{{ url('/vendor/cms/js/vendor/jquery.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/jquery.are-you-sure.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/wysihtml5-toolbar.js') }}"></script>
<script src="{{ url('/vendor/cms/js/vendor/wysihtml5-rules.js') }}"></script>
<script src="{{ url('/vendor/cms/js/plugins.js') }}"></script>
<script src="{{ url('/vendor/cms/js/main.js') }}"></script>
<script src="{{ url('/vendor/cms/js/text.js') }}"></script>

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
