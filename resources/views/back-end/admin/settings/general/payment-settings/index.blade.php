@if (file_exists(resource_path('views/extend/back-end/admin/settings/general/payment-settings/commision-settings.blade.php')))
    @include('extend.back-end.admin.settings.general.payment-settings.commision-settings')
@else
    @include('back-end.admin.settings.general.payment-settings.commision-settings')
@endif
@if (file_exists(resource_path('views/extend/back-end/admin/settings/general/payment-settings/paypal-settings.blade.php')))
    @include('extend.back-end.admin.settings.general.payment-settings.paypal-settings')
@else
    @include('back-end.admin.settings.general.payment-settings.paypal-settings')
@endif
@if (file_exists(resource_path('views/extend/back-end/admin/settings/general/payment-settings/stripe-settings.blade.php')))
    @include('extend.back-end.admin.settings.general.payment-settings.stripe-settings')
@else
    @include('back-end.admin.settings.general.payment-settings.stripe-settings')
@endif