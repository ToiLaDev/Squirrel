<?php namespace App\Http\Controllers\Admin;

use App\Services\Media\MediaService;
use App\Services\ToastResponse;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use ApiResponseTrait;

    public $permissions = [
        //'media.manager' => ['manager']
    ];

    public $breadcrumbs = [
        ['link' => "javascript:void(0)", 'name' => 'Content']
    ];

    public function query(Request $request)
    {
        $medias = MediaService::query($request);
        return $this->success($medias);
    }

    public function manager(Request $request)
    {

        //MediaService::delete([10,8]);

        $this->breadcrumb('Media library');

        return view('Admin::content.media.manager');
    }

    public function window(Request $request)
    {
        return view('Admin::content.media.window');
    }

    public function upload(Request $request)
    {
        $media = MediaService::file($request->file('file'))->folder($request->get('folder_id'))->store();
        return $this->success($media->load('owner:id,first_name,last_name')->toArray());
    }

    public function folder(Request $request)
    {
        $media = MediaService::media($request->get('name'))->folder($request->get('folder_id'))->store();
        return $this->successToast(ToastResponse::SUCCESS_CREATED, $media->load('owner:id,first_name,last_name')->toArray());
    }

    public function rename(int $id, Request $request)
    {
        $media = MediaService::media($id)->rename($request->get('name'));
        return $this->successToast(ToastResponse::SUCCESS_CHANGED, $media->toArray());
    }

    public function delete(int $id, Request $request)
    {
        MediaService::delete([$id]);
        return $this->successToast(ToastResponse::SUCCESS_DELETED);
    }

    public function deletes(Request $request)
    {
        MediaService::delete($request->get('ids'));
        return $this->successToast(ToastResponse::SUCCESS_DELETED);
    }
}
