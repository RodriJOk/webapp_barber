<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollaboratorRequest;
use App\Models\CollaboratorsAvailability;

class CollaboratorAvailableController extends Controller
{
    public function my_collaborators_availability($id)
    {
        $collaborator_availability = CollaboratorsAvailability::getCollaboratorAvailability($id);
        $data = [];
        foreach ($collaborator_availability as $availability) {
            $data[] = [
                'day_of_the_week' => $availability->day_of_the_week,
                'start_time' => $availability->start_time,
                'end_time' => $availability->end_time,
                'start_rest_time' => $availability->start_rest_time,
                'end_rest_time' => $availability->end_rest_time,
            ];
        }
        return view('collaborators_availability.my_collaborators_availability', compact('data'));
    }
}