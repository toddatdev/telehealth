<?php

/**
 * Class EmailTemplateController.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use View;
use Session;
use App\Helper;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

/**
 * Class EmailTemplateController
 *
 */
class EmailTemplateController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $email
     */
    protected $email;

    /**
     * Create a new controller instance.
     *
     * @param instance $email instance
     *
     * @return void
     */
    public function __construct(EmailTemplate $email)
    {
        $this->email = $email;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = array_pluck(Role::all(), 'name', 'id');
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $templates = $this->email::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            $pagination = $templates->appends(
                array(
                    'keyword' => Input::get('keyword'),
                )
            );
        } else if (!empty($request['role'])) {
            $templates = EmailTemplate::getFilterTemplate($request['role']);
        } else {
            $templates = $this->email->getEmailTemplates();
        }
        if (file_exists(resource_path('views/extend/back-end/admin/email-templates/index.blade.php'))) {
            return View::make('extend.back-end.admin.email-templates.index', compact('templates', 'roles'));
        } else {
            return View::make('back-end.admin.email-templates.index', compact('templates', 'roles'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id ID
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $template = $this->email::getEmailTemplateByID($id);
            $variables = !empty($template) && !empty($template->variables) ? Helper::getUnserializeData($template->variables) : '';
            $variables_array = !empty($variables) ? Arr::pluck($variables, 'key', 'value') : array();
            if (file_exists(resource_path('views/extend/back-end/admin/email-templates/edit.blade.php'))) {
                return View::make('extend.back-end.admin.email-templates.edit', compact('template', 'variables_array'));
            } else {
                return View::make('back-end.admin.email-templates.edit', compact('template', 'variables_array'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \App\EmailTemplate       $id      emailTemplate
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::to('admin/email-templates');
        }
        $this->validate(
            $request,
            [
                'title' => 'required',
                'subject' => 'required',
                'email_content' => 'required',
            ]
        );
        $this->email->updateEmailTemplates($request, $id);
        Session::flash('message', trans('lang.email_template_updated'));
        return Redirect::to('admin/email-templates');
    }
}
