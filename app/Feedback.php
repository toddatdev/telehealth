<?php
/**
 * Class Feedback.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Feedback
 *
 */
class Feedback extends Model
{
    public $table = "feedbacks";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'waiting_time', 'rating', 'comment', 'keep_anonymous',
    ];

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Submit Feedback.
     *
     * @param mixed $request $req->attr
     * 
     * @return response
     */
    public static function submitFeedback($request, $patient_id = '')
    {
        $user_rating = array();
        $avg = 0;
        $avg_rating = 0;
        $count = 0;
        $json = array();
        $feedback = new Feedback;
        $user = User::find($request['doctor_id']);
        $feedback->user()->associate($user);
        $feedback->waiting_time = $request['waiting_time'];
        $feedback->keep_anonymous = !empty($request['feedbackpublicly']) ? 'on' : 'off';
        $feedback->comment = filter_var($request['comments'], FILTER_SANITIZE_STRING);
        if (!empty($request['rating'])) {
            foreach ($request['rating'] as $key => $value) {
                if ($value['rate'] > 0) {
                    $count++;
                    $user_rating[$key]['rating'] = intval($value['rate']);
                    $user_rating[$key]['reason'] = intval($value['reason']);
                    $avg = $avg + intval($value['rate']);
                }
            }
            if ($avg <= 0 ) {
                $json['type'] = 'rating_error';
                return $json;
            }
            $avg_rating = $avg / $count;
            $feedback->rating = serialize($user_rating);
        }
        $feedback->avg_rating = $avg_rating;
        $feedback->patient_id = !empty($patient_id) ? $patient_id : Auth::user()->id;
        $feedback->save();

        $user_profile = UserMeta::select('id')->where('user_id', $user->id)
            ->get()->first();
        if (!empty($user_profile->id)) {
            $user_meta = UserMeta::find($user_profile->id);
        } else {
            $user_meta = new UserMeta();
            $user_meta->user()->associate($user->id);
        }
         
        if (!empty($request['votes']) && $request['votes'] == '1') {
            if (!empty($user_meta->votes)) {
                $user_meta->votes = $user_meta->votes + 1; 
            } else {
                $user_meta->votes = intval($request['votes']);
            }
        }
        $user_meta->save();
        return 'success';
    }
}
