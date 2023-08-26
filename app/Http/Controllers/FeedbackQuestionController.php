<?php

namespace App\Http\Controllers;

use App\Models\FeedbackQuestion;
use Illuminate\Http\Request;

class FeedbackQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedbackQuestion $feedbackQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedbackQuestion $feedbackQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedbackQuestion $feedbackQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackQuestion $feedbackQuestion)
    {
        //
    }


    
    // // QuestionController.php
    // public function store(Request $request)
    // {
    //     $question = new FeedbackQuestion();
    //     $question->feedback_form_id = $request->input('feedback_form_id');
    //     $question->question = $request->input('question');
    //     $question->save();

    //     return response()->json(['message' => 'Question created successfully', 'question' => $question]);
    // }
}
