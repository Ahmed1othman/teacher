<?php

use App\Models\Category;
use App\Models\Info;
use App\Models\TeacherCategory;
use App\Models\User;

if (!function_exists('websiteInfo')) {
    function websiteInfo($key)
    {
       $info=Info::where('option',$key)->first();
        if($info){
            if($info->type=='image'){
                 return $info->value != null ? asset('storage/info/'.$info->value ) : null;
            }
            return $info->value;
        }
        return false;
    }

}

if (!function_exists('countStudents')) {
    function countStudents()
    {
       $students=User::where('type','student')->get();
       return count($students);
    }

}

if (!function_exists('countTeachers')) {
    function countTeachers()
    {
       $Teachers=User::where('type','teacher')->get();
       return count($Teachers);
    }

}

if (!function_exists('countUsers')) {
    function countUsers()
    {
       $Users=User::where('type','!=','admin')->get();
       return count($Users);
    }

}

if (!function_exists('countPreliminaryUsers')) {
    function countPreliminaryUsers()
    {
       $Users=User::where('preliminary',1)->get();
       return count($Users);
    }
}

if (!function_exists('countPrimaryUsers')) {
    function countPrimaryUsers()
    {
       $Users=User::where('primary',1)->get();
       return count($Users);
    }
}

if (!function_exists('countUserCategory')) {
    function countUserCategory()
    {
        $data=[];
        $categories=Category::all();
        foreach($categories as $category){
            $users = User::whereHas('categories' ,function ($query) use($category) {
                $query->where('category_id' ,$category->id);
            })->get();

            $data[$category->name]=count($users);
        }

        return $data;
    }
}
if (!function_exists('categoriesDetails')) {
    function categoriesDetails($category_id,$user_id)
    {
        return TeacherCategory::where('category_id',$category_id)->where('user_id',$user_id)->where('active',1)->first();
    }
}

if (!function_exists('countSecondaryUsers')) {
    function countSecondaryUsers()
    {
       $Users=User::where('secondary',1)->get();
       return count($Users);
    }
}


function responseSuccess($data = [], $msg = null, $code = 200)
{
    return response()->json([
        "success" => true,
        "message" => $msg,
        "data" => $data
    ], 200);
}

function responseFail( $error_msg = null , $code = 400, $result = null)
{
    return response()->json([
        "message" => $error_msg,
        "errors" => $result,
        "code"=>$code
    ], 400);
}

function responseValidation($errors = null, $code = 403)
{
    return response()->json([
        "status" => false,
        "errors" => $errors,
    ], 403);
}
