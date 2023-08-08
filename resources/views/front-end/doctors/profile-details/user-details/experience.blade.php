
    @if (!empty($experiences))
        <load-more-experience :title="'{{ trans('lang.experience') }}'" :no_of_post="3" :modal_ref="'experienceModal'" :modal_title="'{{ trans('lang.edu_details') }}'" :url="'/get-doctor-experience'" :doctor_id="'{{ $user->id }}'"></load-more-experience>
    @endif
