<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use Illuminate\Http\Request;

class FeedbackFormController extends Controller
{
    public function allForm()
    {
        $forms = FeedbackForm::with(['questions'])->get();
        return response()->json(['forms' => $forms]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userForms = FeedbackForm::with(['questions'])->where('user_id', auth()->user()->id)->get();
        return response()->json(['forms' => $userForms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Form creation failed.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($link)
    {
        $formDetails = FeedbackForm::with(['questions'])->where('link', $link)->first();

        if (!$formDetails) {
            return response()->json(['message' => 'Form not found.'], 404);
        }

        return response()->json(['data' => $formDetails]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedbackForm $feedbackForm)
    {
    
        try {
            $feedbackForm->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
            // form questions save
            $questions = $request->input('questions');
            foreach ($questions as $question) {
                $feedbackForm->questions()->updateOrCreate(
                    [
                        'id' => $question['id'],
                    ],
                    [
                        'feedback_form_id' => $feedbackForm->id,
                        'question' => $question['question'],
                    ]
                );
            }

            return response()->json(['message' => 'Form updated successfully', 'form' => $feedbackForm]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Form updating failed.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedbackForm $feedbackForm)
    {
        try {
            $feedbackForm->delete();
            return response()->json(['message' => 'Form deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Form deletion failed.'], 500);
        }
    }


    public function submit(Request $request, $formId)
    {
        try {
            $feedbackResponse = FeedbackResponse::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                    'feedback_form_id' => $formId,
                ],
                [
                    'user_id' => auth()->user()->id,
                    'feedback_form_id' => $formId,
                ]
            );

            $answers = json_decode($request->getContent(), true);

            foreach ($answers as $answer) {
                $feedbackResponse->answers()->updateOrCreate(
                    [
                        'feedback_response_id' => $feedbackResponse->id,
                        'feedback_question_id' => $answer['question_id'],
                    ],
                    [
                        'feedback_response_id' => $feedbackResponse->id,
                        'feedback_question_id' => $answer['question_id'],
                        'answer' => $answer['answer'],
                    ]
                );
            }

            return response()->json(['message' => 'Answers submitted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Answers submission failed.'.$th->getMessage()], 500);
        }
    }

    public function answersByUser($link)
    {
        $form = FeedbackForm::where('link', $link)->first();
        $answers = FeedbackResponse::with(['answers'])->where('user_id', auth()->user()->id)->where('feedback_form_id', $form->id)->first();
        return response()->json(['data' => $answers?->answers]);
    }
}
