<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\BookRepo;
use App\Http\Requests\Admin\AppointmentRequest ;
use App\Models\Appointment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File as FacadesFile;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repo;
    protected $namespaceName;
    protected $modelName;



    public function __construct(BookRepo $repo)
    {
       $this->repo = $repo;
       $this->modelName = 'appointments';
       $this->namespaceName = 'admin';

    }
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
       $data=$this->repo->getAll();
        $title=$this->modelName;
        return view($this->namespaceName.'.'.$this->modelName.'.index', compact('data','title'));
    }

    public function create()
    {

    }

    public function AppointmentsRequest ()
    {

        $data=$this->repo->findWhere('status','pending');
        $title='Appointments_request';

        return view($this->namespaceName.'.'.$this->modelName.'.requests', compact('data','title'));
    }

    public function implementationAppointment ()
    {
        $data=$this->repo->findWhere('status','implementation');

        $title='Appointments_implementation';

        return view($this->namespaceName.'.'.$this->modelName.'.implementation', compact('data','title'));
    }

    public function deliveryAppointment ()
    {
        $data=$this->repo->findWhere('status','delivery');
        $title='Appointments_delivery';
        return view($this->namespaceName.'.'.$this->modelName.'.delivery', compact('data','title'));
    }

    public function historyAppointment ()
    {
        $data=Appointment::whereIn('status',['canceld','rejected','completed'])->get();
        $title='Appointments_history';
        return view($this->namespaceName.'.'.$this->modelName.'.history', compact('data','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(AppointmentRequest $request)
    {


    }

    /**
     * update the Permission for dashboard.
     *
     * @param Request $request
     * @return Builder|Model|object
     */
    public function edit($id)
    {

    }

    /**
     * update a permission.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(AppointmentRequest $request,$id)
    {


    }

    public function changeStatus(Request $request)
    {
        try{
            $item=$this->repo->findOrFail($request->id);
            $data['active']=$request->active;
            $data= $this->repo->changeStatus($data,$item);
            if ($data) {
                $response = ['code' => 1, 'msg' => __('admin/app.success_message')];
            } else {
                $response = ['code' => 0, 'msg' => __('admin/app.some_thing_error')];
            }
            return json_encode($response);

       } catch (\Exception $e) {
           DB::rollback();
           $response = ['code' => 0, 'msg' => __('admin/app.some_thing_error')];
           return json_encode($response);
       }
    }
    public function adminChangeStatus($id,Request $request)
    {
        // try{
            $item=$this->repo->findOrFail($id);
            $data['status']=$request->status;

            $data= $this->repo->changeStatus($data,$item);
            if ($data) {
                $response = ['code' => 1, 'msg' => __('admin/app.success_message')];

            } else {
                $response = ['code' => 0, 'msg' => __('admin/app.some_thing_error')];
            }
            return json_encode($response);

    //    } catch (\Exception $e) {
    //        DB::rollback();
    //        $response = ['code' => 0, 'msg' => __('admin/app.some_thing_error')];
    //        return json_encode($response);
    //    }
    }


    /**
     * Delete more than one permission.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $data=$this->repo->bulkDelete([$id]);
        if (!$data ) {
            return __('app.users.cannotdelete');
        }
        return 1;
    }

    public function markAsRead($id,$status)
    {

        $userunreadNotifications = auth()->user()->unreadNotifications;

        foreach ($userunreadNotifications as $notification){
            if($id==$notification->id){
                $notification->markAsRead();
            }
        }

        return redirect()->route($this->modelName.'.'.$status);
    }

}


