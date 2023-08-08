<?php
/**
 * Class ImprovementOptionController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Helper;
use App\ImprovementOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;

/**
 * Class ImprovementOption Controller
 *
 */
class ImprovementOptionController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access protected
     * @var    array $improvement_option
     */
    protected $improvement_option;

    /**
     * Create a new controller instance.
     *
     * @param mixed $improvement_option get ImprovementOption model
     *
     * @return void
     */
    public function __construct(ImprovementOption $improvement_option)
    {
        $this->ImprovementOption = $improvement_option;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $impr_opts = $this->ImprovementOption::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            $pagination = $impr_opts->appends(
                array(
                    'keyword' => Input::get('keyword'),
                )
            );
        } else {
            $impr_opts = $this->ImprovementOption->paginate(10);
        }
        return View::make(
            'back-end.admin.improvementoptions.index', compact('impr_opts')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request Request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'title' => 'required',
            ]
        );
        $this->ImprovementOption->saveImprovementOption($request);
        Session::flash('message', trans('lang.save_ImprovementOption'));
        return Redirect::back();
    }

    /**
     * Edit improvement options.
     *
     * @param string $slug string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $impr_opt = $this->ImprovementOption::where('slug', $slug)->first();
            if (!empty($impr_opt)) {
                return View::make(
                    'back-end.admin.improvementoptions.edit', compact('slug', 'impr_opt')
                );
                return Redirect::to('admin/improvement-options');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update improvement options.
     *
     * @param mixed $request Request attributes
     * @param int   $id      integer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request, [
                'title' => 'required',
            ]
        );
        $this->ImprovementOption->updateImprovementOption($request, $id);
        Session::flash('message', trans('lang.imprv_opts_updated'));
        return Redirect::to('admin/improvement-options');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $Improvement_option = $this->ImprovementOption::find($id);
            $Improvement_option->delete();
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        foreach ($checked as $id) {
            $this->ImprovementOption::where("id", $id)->delete();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            $json['message'] = trans('lang.imprv_opts_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
}
