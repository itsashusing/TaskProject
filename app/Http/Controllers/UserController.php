<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function taskIndex(Request $request)
    {
        $dataQuery = Task::where('user_id', Auth::user()->id);
        if ($request->has('true')) {
            $perPage = $request->input('pageLimit', 10);
            $searchFilter = $request->input('searchFilter');

            if ($searchFilter !== "") {
                $dataQuery->search($searchFilter);
            }

            $data = $dataQuery->paginate($perPage);
            return response()->json($data);
        }
        $page_data['page_title'] = 'All Task List';
        return view('dashboard', compact('page_data'));
    }
    public function add_task(Request $request, $status = null, $id = null)
    {
        if ($status) {
            $task = Task::find($id);
            $task->status = !$task->status;
            $task->save();
            return back()->with('success', 'Status changed ');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [

                'task' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $task = new Task;
            $task->task = $request->task;
            $task->user_id = Auth::user()->id;
            $task->save();
            return back()->with('success', 'Task added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [

                'task' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $task = Task::find($request->id);
            $task->task = $request->task;
            $task->user_id = Auth::user()->id;
            $task->save();
            return back()->with('success', 'Task updated successfully.');
        }
        if ($request->isMethod('delete')) {

            $user = Auth::user();
            if ($user) {
                $task = Task::find($request->id);
                $task->delete();
                return back()->with('success', 'Task deleted successfully.');
            }
            return back();
        }
    }
}
