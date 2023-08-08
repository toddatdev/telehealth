<?php
/**
 * Class Report.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 *
 */
class Report extends Model
{
    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'name', 'email', 'description'
    );

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
     * Submit Report
     *
     * @param mixed $request req->attr
     *
     * @return request\response
     */
    public function submitReport($request)
    {
        if (!empty($request)) {
            $this->name = filter_var($request['name'], FILTER_SANITIZE_STRING);
            $this->email = filter_var($request['email'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $this->save();
            $result = array(
                'type' => 'success',
                'user_id' => $request['user_id'],
            );
            return $result;
        }
    }
}
