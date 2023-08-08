<?php

/**
 * Class EmailTemplate.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use DB;
use function Opis\Closure\serialize;
use Illuminate\Support\Facades\Input;
use function Opis\Closure\unserialize;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate
 *
 */
class EmailTemplate extends Model
{
    /**
     * Get Email Templates
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmailTemplates()
    {
        return DB::table('email_templates')
            ->join('email_types', 'email_types.id', '=', 'email_templates.email_type_id')
            ->select('email_templates.*', 'email_types.*')->paginate(10);
    }

    /**
     * Get Email Template By ID
     *
     * @param int $id email template ID
     *
     * @return \Illuminate\Http\Response
     */
    public static function getEmailTemplateByID($id)
    {
        return DB::table('email_templates')
            ->join('email_types', 'email_types.id', '=', 'email_templates.email_type_id')
            ->select('email_templates.*', 'email_types.*')
            ->where('email_templates.id', $id)
            ->first();
    }

    /**
     * Update Email Template
     *
     * @param string $request get request attributes
     * @param int    $id      get department id for updation
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEmailTemplates($request, $id)
    {
        if (!empty($request)) {
            $template = self::find($id);
            $template->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $template->subject  =  filter_var($request['subject'], FILTER_SANITIZE_STRING);
            $template->content = $request['email_content'];
            return $template->save();
        }
    }

    /**
     * Get filtered email templates
     *
     * @param int $role_id get request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public static function getFilterTemplate($role_id = "")
    {
        $query = '';
        $query = DB::table('email_templates')
            ->join('email_types', 'email_types.id', '=', 'email_templates.email_type_id')
            ->select('email_templates.*', 'email_types.*')
            ->where('email_types.role_id', $role_id)
            ->paginate(10)->setPath('');
        if (!empty($role_id)) {
            $pagination = $query->appends(
                array(
                    'role' => Input::get('role')
                )
            );
            return $query;
        }
    }

    /**
     * Get email type
     *
     * @param int $type_id email type
     *
     * @return \Illuminate\Http\Response
     */
    public static function getEmailType($type_id = "")
    {
        if (!empty($type_id)) {
            $query = DB::table('email_types')->select('email_types.email_type')
                ->where('email_types.id', $type_id)->first();
            if (!empty($query)) {
                return $query;
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}
