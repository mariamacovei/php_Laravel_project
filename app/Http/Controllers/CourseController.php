<?php


namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    public function index()
    {
        return response()->json([
            'courses' => Course::all(),
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
            'price' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validation->errors(),
            ], 200);
        } else {
            $course = new Course;
            $course->name = $request->input('name');
            $course->teacher = $request->input('teacher');
            $course->price = $request->input('price');
            $course->save();

            return response()->json([
                'error' => true,
                'course' => $course,
            ], 200);
        }
    }

    public function delete($id)
    {
        $courses = Course::findOrFail($id);
        $courses->delete();

        return response()->json(null, 204);

    }

    public function update(Request $request,$id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
            'price' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validation->errors(),
            ], 422);
        }
        $course = Course::find($id);
        $course->name = $request->input('name');
        $course->teacher = $request->input('teacher');
        $course->price = $request->input('price');
        $course->save();

        return response()->json([
            'error' => true,
            'message' => "User record successfully updated # $id",
        ], 200);
    }
}
