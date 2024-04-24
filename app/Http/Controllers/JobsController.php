<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\User;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    //Function to to send payslip file to database and to local app storage
    public function addJobApplication(Request $request){

        $jobDetails = $request->validate([

            'users_id' => ['required'],
            'companyName' => ['required'],
            'jobPosition' => ['required'],
            'platform' => ['required'],
            'status' => ['required'],
            'notes' => ['required'],
            
        ]);
        
        // Retrieve the selected user model
        $userModel = User::findOrFail($request->users_id);

        // Create job details associated with the user
        $jobDetails = $userModel->userJobDetails()->create($jobDetails);

        return redirect('/dashboard')->with('status', 'Job details have been submitted successfully');
    }


    //Function to display job applications per logged in user dynamically
    public function jobsDisplayingDatas(Request $request){

        //userJobDetails is from User Model
        $jobDetailsQuery = $request->user()->userJobDetails();

       //Apply search filter if the search term is provided
        if ($request->filled('jobSearch')) {

            //jobSearch is the name of input field from dashboard view
            $searchTerm = $request->input('jobSearch');
            $jobDetailsQuery->where('companyName', 'like', '%' . $searchTerm . '%')
                            ->orWhere('jobPosition', 'like', '%' . $searchTerm . '%');

        }

        $jobDetails = $jobDetailsQuery->paginate(10);

        return view('/dashboard', compact('jobDetails'));

    }
    

    public function deleteCareer($id){

        $jobDetails = Jobs::find($id);
        $jobDetails->delete();

        return redirect('/dashboard')->with('deleteStatus', 'Job Has Been Deleted');


    }

    public function updateJob(Request $request)
    {
        //Find the job by ID
        $job = Jobs::findOrFail($request->job_id);
    
        //Update the job details
        $job->update([
            'companyName' => $request->companyName,
            'jobPosition' => $request->jobPosition,
            'platform' => $request->platform,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
    
        //Redirect back to the dashboard with a success message
        return redirect('/dashboard')->with('status', 'Job details have been updated successfully');
    }

}