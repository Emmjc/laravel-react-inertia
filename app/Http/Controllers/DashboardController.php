<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        //Pending Tasks
        $totalPendingTasks = Task::query()
            ->where('status', 'pending')
            ->count();

        $myPendingTasks = Task::query()
            ->where('status', 'pending')
            ->where('assigned_user_id', $user->id)
            ->count();

        //In Progress Tasks
        $totalProgressTasks = Task::query()
        ->where('status', 'in_progress')
        ->count();

        $myProgressTasks = Task::query()
            ->where('status', 'in_progress')
            ->where('assigned_user_id', $user->id)
            ->count();

        //Completed Tasks
        $totalCompletedTasks = Task::query()
        ->where('status', 'completed')
        ->count();

        $myCompletedTasks = Task::query()
            ->where('status', 'completed')
            ->where('assigned_user_id', $user->id)
            ->count();

        //Active Tasks
        $activeTasks = Task::query()
            ->whereIn('status', ['pending','in_progress'])
            ->where('assigned_user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        $activeTasks = TaskResource::collection($activeTasks);

        return inertia(
            'Dashboard',
            compact(
                'totalPendingTasks',
                'myPendingTasks',
                'totalProgressTasks',
                'myProgressTasks',
                'totalCompletedTasks',
                'myCompletedTasks',
                'activeTasks'
            )
        );
    }
}
