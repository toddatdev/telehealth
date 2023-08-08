<?php
/**
 * Class MediaController
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Facades\Redirect;

/**
 * Class MediaController
 *
 */
class MediaController extends Controller
{
    /**
     * Upload Image to temporary folder.
     *
     * @param mixed  $request   request attributes
     * @param string $type      upload Type
     * @param string $file_name input name attribute
     * @param string $img_type  Image type.
     * 
     * @return \Illuminate\Http\Response
     */
    public function uploadTempImage(Request $request, $type, $file_name, $img_type='')
    {
        $path = Helper::PublicPath() . '/uploads/' . $type . '/temp/';
        $image_size = !empty($img_type) && $img_type != 'null' ? Helper::getImageSizes($img_type) : array();
        if (!empty($request[$file_name])) {
            $file = $request[$file_name];
            return Helper::uploadTempImage($path, $file, $type, $image_size, $img_type);
        }
    }

    /**
     * Download file.
     *
     * @param type    $type     file type
     * @param integer $id       id
     * @param string  $filename file typname
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    function getFile($type, $id, $filename)
    {
        $disk = Helper::getPublicStorageDisk();
        if (!empty($type) && !empty($id) && !empty($filename)) {
            if (file_exists(Helper::publicPath().'/uploads/'.$type . '/' . $id . '/' . $filename)) {
                return Storage::disk($disk)->download('/' . $type . '/' . $id . '/' . $filename);
            } else {
                Session::flash('error', trans('lang.file_not_found'));
                return Redirect::back();
            }
        } else {
            abort(404);
        }
    }
}
