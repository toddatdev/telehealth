
    @if (!empty($educations))
        <load-more-education :title="'{{ trans('lang.education') }}'" :no_of_post="3" :modal_ref="'educationModal'" :modal_title="'{{ trans('lang.edu_details') }}'" :url="'/get-doctor-education'" :doctor_id="'{{ $user->id }}'"></load-more-education>
    @endif
