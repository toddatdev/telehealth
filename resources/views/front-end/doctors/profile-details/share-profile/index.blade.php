<div class="dc-shareprofile">
    <ul class="dc-simplesocialicons dc-socialiconsborder">
        <li class="dc-sharecontent"><span>{{ trans('lang.share_profile') }}</span></li>
        <li class="dc-facebook">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" class="social-share">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>
        <li class="dc-twitter">
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        <li class="dc-linkedin">
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}" class="social-share">
                <i class="fab fa-linkedin-in"></i></a>
        </li>
        <li class="dc-googleplus">
            <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share"><i class="fab fa-google-plus-g"></i></a>
        </li>
    </ul>
</div>
@push('scripts')
    <script>
        var popupMeta = {
        width: 400,
        height: 400
    }
    jQuery(document).on('click', '.social-share', function(event){
        event.preventDefault();

        var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
            hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

        var url = $(this).attr('href');
        var popup = window.open(url, 'Social Share',
            'width='+popupMeta.width+',height='+popupMeta.height+
            ',left='+vPosition+',top='+hPosition+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            return false;
        }
    });
    </script>
@endpush
