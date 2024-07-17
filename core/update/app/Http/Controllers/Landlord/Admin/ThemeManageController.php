<?php

namespace App\Http\Controllers\Landlord\Admin;

use App\Facades\GlobalLanguage;
use App\Facades\ThemeDataFacade;
use App\Helpers\ResponseMessage;
use App\Helpers\SanitizeInput;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThemeManageController extends Controller
{
    public function __construct()
    {

    }

    public function all_theme()
    {
        return view('landlord.admin.themes.index');
    }

    public function update_status(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required'
        ]);

        $theme_file = '';
        $filePath =  theme_path($data['slug']).'/theme.json';
        if (file_exists($filePath) && !is_dir($filePath)){
            //cache data for 10days
            $theme_file = json_decode(file_get_contents($filePath), false);
            if (!empty($theme_file))
            {
                $theme_file->status = !$theme_file->status;
                file_put_contents($filePath ,json_encode($theme_file));
            }
        }
        $status = $theme_file->status == false ? __('Inactive') : __('Active');
        return response()->json([
            'status' => $status,
            'msg' => 'The theme is '.$status.' successfully'
        ]);
    }

    public function update_theme(Request $request)
    {
        $theme_data = [
            'theme_slug' => 'required',
            'theme_url' => 'nullable',
            'theme_image' => 'nullable',
            'theme_is_available' => 'nullable'
        ];


        foreach (\App\Facades\GlobalLanguage::all_languages(1) as $lang){
            $theme_slug = $request->theme_slug;

            $translation_fields = [
                'theme_name_'.$lang->slug,
                'theme_description_'.$lang->slug,
            ];


            foreach ($translation_fields as $item){
                $value = $item;
                update_static_option_central($theme_slug.'_'.$item,$request->$value );
            }

        }

        $this->validate($request, $theme_data);
        $image_id = $request->theme_image;
        $availability = $request->theme_is_available;


        $image = get_attachment_image_by_id($request->theme_image);
        $image_url = !empty($image) ? $image['img_url'] : '';

        unset($theme_data['theme_slug']);
        $request['theme_image'] = $image_url;

        foreach ($theme_data as $field_name => $rules){
            update_static_option_central($request->theme_slug.'_'.$field_name, $request->$field_name);
        }
        update_static_option_central($request->theme_slug.'_theme_image_id', $image_id);
        update_static_option_central($request->theme_slug.'_theme_is_available', $availability);


        return response()->success(ResponseMessage::SettingsSaved());
    }

    public function theme_settings()
    {
        return view('landlord.admin.themes.settings');
    }

    public function theme_settings_update(Request $request)
    {
        $this->validate($request, [
            'up_coming_themes_backend' => 'nullable|string',
            'up_coming_themes_frontend' => 'nullable|string',
        ]);
        update_static_option('up_coming_themes_backend', $request->up_coming_themes_backend);
        update_static_option('up_coming_themes_frontend', $request->up_coming_themes_frontend);

        return redirect()->back()->with([
            'msg' => __('Theme Settings Updated ...'),
            'type' => 'success'
        ]);
    }

}
