<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\AppointmentRepo;
use App\Http\Requests\Api\BookRequest;
use App\Http\Requests\Api\AppointmentRequest;
use App\Http\Requests\BulkDeleteRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\SearchResource;
use App\Http\Resources\UserResource;
use App\Models\Appointment;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Schema;

class AppointmentController extends Controller
{
    protected $repo;

    public function __construct(AppointmentRepo $repo)
    {
        $this->repo = $repo;
    }

    public function search(Request $request)
    {
        $data=User::where('name','like','%'.$request->teacher.'%')->where('type','teacher')->get();
        return responseSuccess([
            'data' =>  UserResource::collection($data),
        ], __('app.data_returned_successfully'));
    }

    public function index(Request $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Appointment();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? AppointmentResource::collection($data) : SearchResource::collection($data),
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
            'data' => new AppointmentResource($data),
        ], __('app.data_returned_successfully'));
    }
    public function getteacher($id)
    {

        $data = Appointment::where('user_id',$id)->get();
        return responseSuccess([
            'data' =>  $data,
        ], __('app.data_returned_successfully'));
    }

    public function store(AppointmentRequest $request)
    {
        try {
            $times=Appointment::where('time',$request->time)->where('active',1)->where('user_id',auth()->id())->first();
            if($times){
                $day=date('Y-m-d');
                $time_date=$times->created_at->format('Y-m-d');
                $fdate = $time_date;
                $tdate = $day;
                $datetime1 = new DateTime($fdate);
                $datetime2 = new DateTime($tdate);
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');
                if($days<31){
                    return responseFail(__('Time not available'));
                }
            }
            $input = [
                'time' => $request->time,
                'user_id' => auth()->id(),
            ];
            $data = $this->repo->create($input);
            if ($data) {
                return responseSuccess(new AppointmentResource($data));
            } else {
                return responseFail(__('app.some_thing_error'));
            }
        } catch (\Exception $e) {
            return responseFail(__('app.some_thing_error'));
        }
    }

    public function update($id, AppointmentRequest $request)
    {
        $item = $this->repo->findOrFail($id);
        $input = [
            'time' => $request->time,
            'user_id' => auth()->id(),
        ];

        $data = $this->repo->update($input, $item);
        if ($data) {
            return responseSuccess(new AppointmentResource($item->refresh()), __('app.data_Updated_successfully'));
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
