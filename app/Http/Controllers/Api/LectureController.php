<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\LectureRepo;
use App\Http\Requests\Api\LectureRequest;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Resources\LectureResource;
use App\Http\Resources\SearchResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Schema;

class LectureController extends Controller
{
    protected $repo;

    public function __construct(LectureRepo $repo)
    {
        $this->repo = $repo;

    }

    public function index(Request $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Lecture();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? LectureResource::collection($data) : SearchResource::collection($data),
            'meta' => [
                'total' => $data->count(),
                'currentPage' => $input["offset"],
                'lastPage' => $input["paginate"] != "false" ? $data->lastPage() : 1,
            ],
        ], __('app.data_returned_successfully'));
    }

    public function get($id)
    {
        $data = $this->repo->findOrFail($id);

        return responseSuccess([
            'data' => new LectureResource($data),
        ], __('app.data_returned_successfully'));
    }

    public function store(LectureRequest $request)
    {

        try {
            $input = [
                'name' => $request->name,
                'month' => $request->month,
                'category_id' => $request->category_id,
                'type' => $request->type,
                'time' => $request->time,
                'user_id' => auth()->id(),
            ];
            $fileUpload = request()->file('photo');
            if ($fileUpload) {
                $input['photo'] = $this->repo->storeFile($fileUpload, 'lectures');
            }
            $data = $this->repo->create($input);


            if ($data) {
                return responseSuccess(new LectureResource($data));
            } else {
                return responseFail(__('app.some_thing_error'));
            }

        } catch (\Exception $e) {
            return responseFail(__('app.some_thing_error'));
        }

    }

    public function update($id, LectureRequest $request)
    {
        $item = $this->repo->findOrFail($id);
        $input = [
            'name' => $request->name,
            'month' => $request->month,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'time' => $request->time,
            'user_id' => auth()->id(),
        ];
        $fileUpload = request()->file('photo');
        if ($fileUpload) {
            FacadesFile::delete('public/lectures/' . $item->photo);
            $input['photo'] = $this->repo->storeFile($fileUpload, 'lectures');
        }
        $data = $this->repo->update($input, $item);
        if ($data) {
            return responseSuccess(new LectureResource($item->refresh()), __('app.data_Updated_successfully'));
        } else {
            return responseFail(__('app.some_thing_error'));
        }
    }

    public function bulkDelete(BulkDeleteRequest $request)
    {

        DB::beginTransaction();
        try {

            $data = $this->repo->bulkDelete($request->ids);
            if ($data) {

                DB::commit();
                return responseSuccess([], __('app.data_deleted_successfully'));
            } else {
                return responseFail(__('app.some_thing_error'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return responseFail(__('app.some_thing_error'));
        }
    }

    public function bulkRestore(BulkDeleteRequest $request)
    {
        try {
            $data = $this->repo->bulkRestore($request->ids);
            if ($data) {
                return responseSuccess([], __('app.data_restored_successfully'));
            } else {
                return responseFail(__('app.some_thing_error'));
            }
        } catch (\Exception $e) {
            return responseFail(__('app.some_thing_error'));
        }
    }


}
