<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use Illuminate\Http\Request;

class FeedbackFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userForms = FeedbackForm::where('user_id', auth()->user()->id)->get();
        return response()->json(['forms' => $userForms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
            $form = FeedbackForm::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            // form questions save
            $questions = $request->input('questions');
            foreach ($questions as $question) {
                $form->questions()->create([
                    'feedback_form_id' => $form->id,
                    'question' => $question['question'],
                ]);
            }

            return response()->json(['message' => 'Form created successfully', 'form' => $form]);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => 'Form creation failed.'], 500);
        // }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedbackForm $feedbackForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedbackForm $feedbackForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedbackForm $feedbackForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackForm $feedbackForm)
    {
        //
    }
}
