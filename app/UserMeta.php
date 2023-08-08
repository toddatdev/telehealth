<?php

/**
 * Class UserMeta.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use App\User;
use File;
use Illuminate\Database\Eloquent\Model;
use Hash;

/**
 * Class UserMeta
 *
 */
class UserMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'experiences', 'specializations', 'memberships',
        'educations', 'awards', 'services', 'avatar', 'banner', 'gender',
        'gender_title', 'sub_heading', 'tagline', 'description',
        'delete_reason', 'delete_description', 'payout_id', 'profile_searchable', 'profile_blocked', 'weekly_alerts',
        'message_alerts', 'verify_medical', 'consultation_fee', 'saved_hospitals', 'saved_doctors',
        'saved_articles', 'downloads', 'verify_registration', 'liked_answer', 'starting_price'
    ];

    /**
     * Get the user that has the profile.
     *
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Store Profile in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeProfile($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user = User::find($user_id);
            if ($user->first_name . '-' . $user->last_name != $request['first_name'] . '-' . $request['last_name']) {
                $user->slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                    filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            }
            $user->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
	    $user->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);

	    $user->practicename = filter_var($request['practicename'], FILTER_SANITIZE_STRING);
	    $user->zoomlink = filter_var($request['zoomlink'], FILTER_SANITIZE_STRING);
	    $user->gotomeetinglink = filter_var($request['gotomeetinglink'], FILTER_SANITIZE_STRING);

	    $user->daddress1 = filter_var($request['daddress1'], FILTER_SANITIZE_STRING);
	    $user->immediate_bookings = filter_var($request['immediate_bookings'], FILTER_SANITIZE_STRING);
	    $user->patientbirth = filter_var($request['patientbirth'], FILTER_SANITIZE_STRING);
	    $user->paypal_address = filter_var($request['paypal_address'], FILTER_SANITIZE_STRING);
            $user->daddress2 = filter_var($request['daddress2'], FILTER_SANITIZE_STRING);
            $user->city = filter_var($request['city'], FILTER_SANITIZE_STRING);
            $user->state = filter_var($request['state'], FILTER_SANITIZE_STRING);
            $user->zipcode = filter_var($request['zipcode'], FILTER_SANITIZE_STRING);
            $user->phonenumber = filter_var($request['phonenumber'], FILTER_SANITIZE_STRING);
	    $user->country = filter_var($request['country'], FILTER_SANITIZE_STRING);
	    $languageitems = "";
	    if($request['language']) {
            	foreach ($request['language'] as $languagelist)
            	{
                	$languageitems = $languageitems.$languagelist.", ";
            	}
	    	$languageitems = rtrim($languageitems, ", ");
	    } else {
	    	$languageitems = "";
	    }
	    $user->languagelist = filter_var($languageitems, FILTER_SANITIZE_STRING);


            if (!empty($request['email'])) {
                $user->email = filter_var($request['email'], FILTER_SANITIZE_STRING);
            }
            if (!empty($request['location'])) {
                $location = Location::find($request['location']);
                $user->location()->associate($location);
            }
            if (!empty($request['password'])) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
	    $user_meta->gender_title = !empty($request['base_name']) ? $request['base_name'] : null;
	    $user_meta->gender = !empty($request['gender_name']) ? $request['gender_name'] : null;
            $user_meta->sub_heading = !empty($request['subheading']) ? filter_var($request['subheading'], FILTER_SANITIZE_STRING) : null;
            $user_meta->description = !empty($request['description']) ? filter_var($request['description'], FILTER_SANITIZE_STRING) : null;
            $user_meta->address = !empty($request['address']) ? filter_var($request['address'], FILTER_SANITIZE_STRING) : null;
            $user_meta->longitude = !empty($request['longitude']) ? filter_var($request['longitude'], FILTER_SANITIZE_STRING) : null;
            $user_meta->latitude = !empty($request['latitude']) ? filter_var($request['latitude'], FILTER_SANITIZE_STRING) : null;
            if (!empty($request['days'])) {
                $user_meta->available_days = serialize($request['days']);
            }
            if (!empty($request['working_time'])) {
                $user_meta->working_time = $request['working_time'];
            }
            if (!empty($request['starting_price'])) {
                $user_meta->starting_price = $request['starting_price'];
            }
            $old_path = Helper::PublicPath() . '/uploads/users/temp';
            $new_path = Helper::PublicPath() . '/uploads/users/' . $user_id;
            if (!empty($request['avatar_img'])) {
                $profile_img_sizes = Helper::getImageSizes('profile_img');
                $filename = $request['avatar_img'];
                if (file_exists($old_path . '/' . $request['avatar_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['avatar_img'];
                    if (!empty($profile_img_sizes)) {
                        foreach ($profile_img_sizes as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $request['avatar_img'], $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['avatar_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['avatar_img'], $new_path . '/' . $filename);
                    }
                }
                $user_meta->avatar = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $user_meta->avatar = null;
            }
            if (!empty($request['avatar_banner_img'])) {
                $banner_img_sizes = Helper::getImageSizes('profile_banner');
                $filename = $request['avatar_banner_img'];
                if (file_exists($old_path . '/' . $request['avatar_banner_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['avatar_banner_img'];
                    if (!empty($banner_img_sizes)) {
                        foreach ($banner_img_sizes as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $request['avatar_banner_img'], $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $request['avatar_banner_img'], $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $request['avatar_banner_img'], $new_path . '/' . $filename);
                    }
                }
                $user_meta->banner = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $user_meta->banner = null;
            }
            $memberships = !empty($request['membership']) ? $request['membership'] : array();
            if (!empty($memberships)) {
                foreach ($memberships as $key => $membership) {
                    $memberships[$key]['title'] = $membership['title'];
                }
                $user_meta->memberships = serialize($memberships);
            } else {
                $user_meta->memberships = null;
            }
            $user_meta->save();
            return 'success';
        }
    }

    /**
     * Store Registration in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeRegistration($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $old_path = Helper::PublicPath() . '/uploads/users/temp';
            $new_path = Helper::PublicPath() . '/uploads/users/' . $user_id;
            if (!empty($request['registration_document'])) {
                $filename = $request['registration_document'];
                if (file_exists($old_path . '/' . $request['registration_document'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['registration_document'];
                    rename($old_path . '/' . $request['registration_document'], $new_path . '/' . $filename);
                }
            }
            $data = array(
                "registration_number" => $request['registration_number'],
                "registration_document" => $filename,
            );
            $user_meta->verify_medical = serialize($data);
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store awards and downloads
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeGallery($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            if (!empty($request['images'])) {
                $old_path = Helper::PublicPath() . '/uploads/users/temp';
                $new_path = Helper::PublicPath() . '/uploads/users/'.$user_id.'/gallery/images';
                $gallery_img_sizes = Helper::getImageSizes('profile_gallery');
                foreach ($request['images'] as $key => $user_gallery) {
                    $filename = $user_gallery;
                    if (file_exists($old_path . '/' . $user_gallery)) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $user_gallery;
                        if (!empty($gallery_img_sizes)) {
                            foreach ($gallery_img_sizes as $gallery_key => $size) {
                                rename($old_path . '/' . $gallery_key . '-' . $user_gallery, $new_path . '/' . $gallery_key . '-' . $filename);
                            }
                            rename($old_path . '/' . $user_gallery, $new_path . '/' . $filename);
                        } else {
                            rename($old_path . '/' . $user_gallery, $new_path . '/' . $filename);
                        }
                    }
                    $gallery_images[$key] = $filename;
                }
                $user_meta->gallery = serialize($gallery_images);
            } else {
                $user_meta->gallery = null;
            }
            $videos = !empty($request['video']) ? $request['video'] : array();
            if (!empty($videos)) {
                foreach ($videos as $key => $video) {
                    $videos[$key]['url'] = $video['url'];
                }
                $user_meta->gallery_videos = serialize($videos);
            } else {
                $user_meta->gallery_videos = null;
            }
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store awards and downloads
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeAwardsDownloads($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $awards = $request['awards'];
            $downloads = $request['attachments'];
            foreach ($awards as $key => $award) {
                $awards[$key]['title'] = $award['title'];
                $awards[$key]['year'] = date('Y', strtotime($award['year']));
            }
            $old_path = Helper::PublicPath() . '/uploads/users/temp';
            $new_path = Helper::PublicPath() . '/uploads/users/'. $user_id;
            if (!empty($downloads)) {
                foreach ($downloads as $key => $download) {
                    $filename = $download;
                    if (file_exists($old_path . '/' . $download)) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $download;
                        rename($old_path . '/' . $download, $new_path . '/' . $filename);
                    }
                    $downloads[$key] = $filename;
                }
            } 
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->awards = serialize($awards);
            if (!empty($request['attachments'])) {
                $user_meta->downloads = serialize($downloads);
            } else {
                $user_meta->downloads = null;
            }
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store Account Settings
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return save data
     */
    public function storeAccountSettings($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
                $user_meta->user()->associate($user_id);
            }
            $user_meta->profile_searchable = $request['profile_searchable'];
            $user_meta->disable_account = $request['disable_account'];
            $user_meta->save();
        } else {
            return '';
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveExperiences($request, $user_id)
    {
        $json = array();
        $count = 0;
        $request_experience = array();
        if (!empty($request) && !empty($user_id)) {
            if ($request['experience']) {
                foreach ($request['experience'] as $key => $experience) {
                    if (
                        empty($experience['job_title'])  || empty($experience['start_date'])
                        || empty($experience['end_date']) || empty($experience['company_title'])
                    ) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.empty_fields_not_allowed');
                        return $json;
                    }

                    if ($experience['company_title'] == 'Company Title') {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.empty_fields_not_allowed');
                        return $json;
                    }
                    $request_experience[$count] = $experience;
                    $count++;
                }
            }
            $experience = !empty($request['experience']) ? serialize($request_experience) : '';
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->experiences = $experience;
            $user_meta->save();
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveServices($request, $user_id)
    {
        $json = array();
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            $role_type = Helper::getRoleTypeByUserID($user_id);
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
                $user_meta->user()->associate($user_id);
            }
            if (!empty($request['services'])) {
                $user = User::findorFail($user_id);
                $user->services()->detach();
                $speciality_services = array();
                $services = $request['services'];
                foreach ($services as $key => $service) {
                    if (empty($service['speciality'])) {
                        $json['type'] = 'speciality_required';
                        return $json;
                    }
                    $speciality_services[$key]['speciality_id'] = $service['speciality'];
                    if (!empty($service['service'])) {
                        foreach ($service['service'] as $service_key => $speciality_service) {
                            if (empty($speciality_service['service'])) {
                                $json['type'] = 'service_required';
                                return $json;
                            }
                            $speciality_services[$key]['services'][$service_key]['service'] = $speciality_service['service'];
                            $speciality_services[$key]['services'][$service_key]['price'] = $speciality_service['price'];
                            $speciality_services[$key]['services'][$service_key]['description'] = $speciality_service['description'];
                            $user->services()->attach($speciality_service['service'], ['type' => $role_type, 'speciality' => $service['speciality']]);
                        }
                    }
                }
                $user_meta->services = serialize($speciality_services);
                $user_meta->save();
                $json['type'] = 'success';
                return $json;
            } else {
                $user_meta->services = null;
                $user_meta->save();
                $json['type'] = 'success';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveEducations($request, $user_id)
    {
        $json = array();
        $count = 0;
        $request_education = array();
        if (!empty($request) && !empty($user_id)) {
            if (!empty($request['education'])) {
                foreach ($request['education'] as $key => $education) {
                    if (
                        $education['degree_title'] == 'Degree title' || $education['start_date'] == 'Start Date'
                        || $education['end_date'] == 'End Date' || empty($education['job_title'])
                        || empty($education['start_date']) || empty($education['end_date'])
                        || empty($education['degree_title'])
                    ) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.empty_fields_not_allowed');
                        return $json;
                    }
                    $request_education[$count] = $education;
                    $count++;
                }
            }
            $education = !empty($request['education']) ? serialize($request_education) : '';
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->educations = $education;
            $user_meta->save();
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Add to whish list
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function addWishlist($column, $id, $user_id)
    {
        $wishlist = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $wishlist = unserialize($profile[$column]);
            $wishlist = !empty($wishlist) && is_array($wishlist) ? $wishlist : array();
            $wishlist[] = $id;
            $wishlist = array_unique($wishlist);
            $profile->$column = serialize($wishlist);
            $profile->save();
            return "success";
        } else {
            return 'error';
        }
    }

    /**
     * Remove to whish list
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function removeWishlist($column, $id, $user_id)
    {
        $wishlist = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $wishlist = unserialize($profile[$column]);
            $wishlist = !empty($wishlist) && is_array($wishlist) ? $wishlist : array();
            $wishlist[] = $id;
            $newwishlist = array_diff($wishlist, array($id));
            $profile->$column = serialize($newwishlist);
            $profile->save();
            return "success";
        } else {
            return 'error';
        }
    }

    /**
     * Add liked Answer
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function likeAnswer($column, $id, $user_id)
    {
        $like_answer = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $like_answer = unserialize($profile[$column]);
            $like_answer = !empty($like_answer) && is_array($like_answer) ? $like_answer : array();
            $like_answer[] = $id;
            $like_answer = array_unique($like_answer);
            $profile->$column = serialize($like_answer);
            $profile->save();
            return "success";
        } else {
            return "error";
        }
    }

    /**
     * Save Payout Details.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function savePayoutDetail($request, $user_id)
    {
        $payouts = array();
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $profile = self::find($user_profile->id);
            } else {
                $profile = $this;
            }
            $profile->user()->associate($user_id);
            if (!empty($request['payout_settings'])) {
                $payout_setting = $request['payout_settings'];
                $payouts['type'] = $payout_setting['type'];
                if ($payout_setting['type'] == 'paypal') {
                    $payouts['paypal_email'] = $payout_setting['paypal_email'];
                } elseif ($payout_setting['type'] == 'bacs') {
                    $payouts['bank_account_name'] = $payout_setting['bank_account_name'];
                    $payouts['bank_account_number'] = $payout_setting['bank_account_number'];
                    $payouts['bank_name'] = $payout_setting['bank_name'];
                    $payouts['bank_routing_number'] = $payout_setting['bank_routing_number'];
                    $payouts['bank_iban'] = $payout_setting['bank_iban'];
                    $payouts['bank_bic_swift'] = $payout_setting['bank_bic_swift'];
                }
            }
            $profile->payout_settings  = serialize($payouts);
            $profile->save();
            return 'success';
        } else {
            return 'error';
        }
    }
}
