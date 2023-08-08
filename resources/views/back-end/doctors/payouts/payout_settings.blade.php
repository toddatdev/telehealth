@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="dc-haslayout la-ps-doctors">
        <div class="doctors-profile" id="invoice_list">
            <div class="preloader-section" v-if="loading" v-cloak>
                <div class="preloader-holder">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="dc-dashboardbox dc-dashboardtabsholder">
                        @if (file_exists(resource_path('views/extend/back-end/doctors/payouts/tabs.blade.php')))
                            @include('extend.back-end.doctors.payouts.tabs')
                        @else
                            @include('back-end.doctors.payouts.tabs')
                        @endif
                        <div class="dc-tabscontent tab-content">
                            <div class="dc-tabscontenttitle">
                                <h3>{{ trans('lang.payout_settings') }}</h3>
                            </div>
                            <div class="dc-sidepadding">
                                <div class="dc-settingscontent">
                                    <div class="dc-description">
                                        <p>{{ trans('lang.payout_settings_note') }}</p>
                                    </div>
                                    <form class="dc-formtheme dc-payout-settings la-payout-settings" @submit.prevent="submitPayoutsDetail({{Auth::user()->id}})" id="profile_payout_detail">
                                        @if (!empty($payrols))
                                            @foreach ($payrols as $pay_key	=> $payrol)
                                                @php
                                                    $vue_display = $payrol['id'] == 'bacs' ? 'show_bank_fields' : 'show_paypal_fields';
                                                    $checked =  !empty($payout_settings['type']) && $payout_settings['type'] == $payrol['id'] ? 'checked' : '';
                                                @endphp
                                                @if (!empty($payrol['status']) && $payrol['status'] === 'enable')
                                                    <fieldset>
                                                        <div class="dc-checkboxholder">
                                                            <span class="dc-radio">
                                                                <input id="payrols-{{$payrol['id']}}" type="radio" name="payout_settings[type]" value="{{$payrol['id']}}" v-on:change="changePayout('{{$payrol['id']}}')" {{$checked}}>
                                                                <label for="payrols-{{$payrol['id']}}">
                                                                    <figure class="dc-userlistingimg">
                                                                        <img src="{{$payrol['img_url']}}" alt="{{$payrol['title']}}">
                                                                    </figure>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="fields-wrapper dc-haslayout" v-if="{{$vue_display}}" v-cloak>
                                                            <div class="dc-description">
                                                                @if ($payrol['id'] == 'paypal')
                                                                    <p>
                                                                        {{ trans('lang.paypal_payout_id_text') }} 
                                                                        <a target="_blank" href="https://www.paypal.com/"> {{ trans('lang.paypal') }} </a> | 
                                                                        <a target="_blank" href="https://www.paypal.com/signup/">{{ trans('lang.payout_id_create_acc') }}</a>
                                                                    </p>
                                                                @elseif ($payrol['id'] == 'bacs')
                                                                    <p>{{ trans('lang.bank_payout_id_text') }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="dc-formtheme dc-userform">
                                                                <fieldset> 
                                                                    @if (!empty($payrol['fields']))
                                                                        @foreach ($payrol['fields'] as $key => $field)
                                                                            @php $db_value	= !empty($payout_settings[$key]) ? $payout_settings[$key] : ""; @endphp
                                                                            <div class="form-group form-group-half toolip-wrapo">
                                                                                <input type="{{$field['type']}}" name="payout_settings[{{$key}}]" id="{{$key}}-payrols" class="form-control" 
                                                                                    placeholder="{{$field['placeholder']}}" value="{{$db_value}}">
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                @endif
                                            @endforeach
                                        @endif
                                        <fieldset>
                                            <div class="form-group dc-btnarea">
                                                <button type="submit" class="dc-btn dc-payrols-settings" data-id="<?php echo $payrol['id']; ?>">{{ trans('lang.submit') }}</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
