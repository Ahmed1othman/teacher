<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\BookRepo;
use App\Http\Requests\Api\BookRequest;

use App\Http\Requests\BulkDeleteRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\SearchResource;
use App\Models\Appointment;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Schema;

class BookController extends Controller
{
    protected $repo;

    public function __construct(BookRepo $repo)
    {
        $this->repo = $repo;

    }

    public function index(Request $request)
    {
        $input = $this->repo->inputs($request->all());
        $model = new Book();
        $columns = Schema::getColumnListing($model->getTable());

        if (count($input["columns"]) < 1 || (count($input["columns"]) != count($input["column_values"])) || (count($input["columns"]) != count($input["operand"]))) {
            $wheres = [];
        } else {
            $wheres = $this->repo->whereOptions($input, $columns);

        }
        $data = $this->repo->Paginate($input, $wheres);

        return responseSuccess([
            'data' => $input["resource"] == "all" ? BookResource::collection($data) : SearchResource::collection($data),
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
            'data' => new BookResource($data),
        ], __('app.data_returned_successfully'));
    }


    public function store(BookRequest $request)
    {
        // try {
            $input = [
                'status' => 'pending',
                'appointment_id' => $request->appointment_id,
                'user_id' => auth()->id(),
            ];
            $appointment=Appointment::find($request->appointment_id);
                if($appointment->type=='single'){
                    $books=Book::where('appointment_id',$request->appointment_id)->first();
                    if($books){
                        return responseFail(__('admin/app.this_appointment_compleated'));
                    }
                }else{
                    $books=Book::where('appointment_id',$request->appointment_id)->count();
                    if($books>=5){
                        return responseFail(__('admin/app.this_appointment_compleated'));
                    }elseif($books==0){
                        if($request->type){
                            if($request->type=='single'||$request->type=='group'){
                                $appointment->category_id=auth()->user()->category_id;
                                $appointment->type=$request->type;
                            }else{
                                    return responseFail('Type Invalied should be in single or group');
                                }
                            }else{
                                return responseFail('Type required');
                        }
                        $appointment->category_id=auth()->user()->category_id;
                        $appointment->type=$request->type;
                    }
                }
                $data = $this->repo->create($input);
            if ($data) {
                $appointment->category_id=auth()->user()->category_id;
                $appointment->type=$request->type;
                $appointment->save();
                return responseSuccess(new BookResource($data));
            } else {
                return responseFail(__('app.some_thing_error'));
            }
        // } catch (\Exception $e) {
        //     return responseFail(__('app.some_thing_error'));
        // }
    }

    public function update($id, BookRequest $request)
    {
        try{
        $item = $this->repo->findOrFail($id);

            $input = [
                'appointment_id' => $request->appointment_id,
                'user_id' => auth()->id(),
            ];
            $appointment=Appointment::find($request->appointment_id);
                if($appointment->type=='single'){
                    $books=Book::where('appointment_id',$request->appointment_id)->first();
                    if($books){
                        return responseFail(__('admin/app.this_appointment_compleated'));
                    }
                }else{
                    $books=Book::where('appointment_id',$request->appointment_id)->count();
                    if($books>=5){
                        return responseFail(__('admin/app.this_appointment_compleated'));
                    }elseif($books==0){
                        $request->validate([
                            'type' => ['required', 'in:single,group']
                        ]);
                        $appointment->category_id=auth()->user()->category_id;
                        $appointment->type=$request->type;
                    }
                }
                $data = $this->repo->update($input,$item);
            if ($data) {
                return responseSuccess(new BookResource($data));
            } else {
                return responseFail(__('app.some_thing_error'));
            }
        } catch (\Exception $e) {
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
