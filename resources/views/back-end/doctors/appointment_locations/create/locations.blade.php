<div class="dc-haslayout">
    <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle">
            <h2>{{ trans('lang.appointment_locations') }}</h2>
        </div>
        <div class="dc-dashboardboxcontent dc-clinicloc-holder">
            <div class="dc-tabscontenttitle">
                <h3>{{ trans('lang.avaiable_locations') }}</h3>
            </div>
            <div class="dc-content-holder">
                @if (!empty($doctor_info) && $doctor_info->count() > 0)
                    @foreach ($doctor_info as $key => $info)
                        @php
                            $team = \App\Team::findOrFail($info->id);
                            $hospital_obj = App\User::findOrFail($team->hospital->id);
                            $slots = unserialize($team->slots);
                            $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
                        @endphp
                        <div class="dc-clinics" id="appointsetidcheck{{ intVal(clean($team->id)) }}">
                            <div>
                                <figure class="dc-clinicsimg">
                                    <img src="{{ asset(Helper::getImage('uploads/users/'.$team->hospital->id, $team->hospital->profile->avatar, 'small-', 'user.jpg')) }}" alt="{{ trans('lang.img_desc') }}">
                                </figure>
                            </div>
                            <div class="dc-clinics-content">
                                <div class="dc-clinics-title">
                                    <a href="javascript:void(0);">{{ $team->status }}</a>
                                    <h4>{{ Helper::getUserName($team->hospital->id) }} {{ Helper::verifyUser(intVal(clean($team->hospital->id))) }}</h4>
                                    <span>
                                        @if (!empty($appointment_days))
                                            <span>
                                                @foreach (Helper::getAppointmentDays() as $key => $day)
                                                    @if (!in_array($key, $appointment_days))
                                                       <em class="dc-dayon">{{ html_entity_decode(clean($day['title'])) }}</em>
                                                    @else
                                                       {{ html_entity_decode(clean($day['title'])) }},
                                                    @endif
                                                @endforeach
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <div class="dc-btnarea">
                                    <a href="{{ route('editLocation', ['id' => intVal(clean($team->id))]) }}" class="dc-btn dc-btn-sm">
                                        {{ trans('lang.view_details') }}
				    </a>
				    <a href="javascript:void(0);" v-on:click="deleteAppointSet('{{ intVal(clean($team->id)) }}', 'Do you want to delete this setting', 'setting deleted', 'successfully')" class="dc-btn dc-btn-sm" style="display: block; margin-top: 20px;">
					Delete Setting
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ( method_exists($doctor_info,'links') )
                        <div class="dc-categoriescontentholder">
                            {{ $doctor_info->links('pagination.custom') }}
                        </div>
                    @endif
                @else
                    @include('errors.no-record')
                @endif
            </div>
        </div>
    </div>
</div>
