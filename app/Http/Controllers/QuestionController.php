<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuestionController extends Controller
{

    // Show all questions
    public function index()
    {
        return view('questions.index', [
            'questions' => Question::latest()->filter(request(['search']))->paginate(20)
        ]);
    }

    //Show single listing
    public function show(Question $question) {
        return view('questions.question', [
            'id' => $question->id,
            'mode' => 'show',
            'type' => $question->type,
            'types' => Question::QUESTION_TYPES,
            'body' => $question->body,
            'answers' => $question->answers,
        ]);
    }

    // Show Create Form
    public function create(Request $request)
    {
        $type = $request->query('type');
        return view('questions.question', [
            'type' => $type,
            'types' => Question::QUESTION_TYPES,
        ]);
    }

    // Store Question Data
    public function store(Request $request)
    {

        $fields = $request->validate([
            'body' => 'string|required',
            'type' => 'string|required',
            'answers' => 'array|required',
            'answers.*.body' => 'string|required',
            'answers.*.result' => 'string|required',
        ]);

        $correctAnswersCount = count(Arr::where($request->answers, function ($value, $key) {
            return $value['result'] != 0;
        }));

        if ($correctAnswersCount == 0) {
            return redirect()->back()->with('status', 'error')->with('message', 'You must have at least one correct answer!')->with('answers', $fields['answers']);
        }

        if ($request->type == 'redio' && $correctAnswersCount > 1) {
            return redirect()->back()->with('status', 'error')->with('message', 'You can have only one correct answer for question of type `radio`!')->with('answers', $fields['answers']);
        }

        $questionFields = Arr::except($fields, ['answers']);
        $question = Question::create($questionFields);

        foreach ($fields['answers'] as $answerData) {
            $answer = new Answer();
            $answer->body = $answerData['body'];
            $answer->result = $answerData['result'];
            $answer->question_id = $question['id'];
            $answer->save();
        }

        return redirect('/questions')->with('status', 'success')->with('message', 'Question created successfully!');
    }

    // Store Question Data
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/questions')->with('status', 'success')->with('message', 'Question deleted successfully!');
    }
    
    // Show Edit Form
    public function edit(Question $question) {
        return view('questions.question', [
            'id' => $question->id,
            'mode' => 'edit',
            'type' => $question->type,
            'types' => Question::QUESTION_TYPES,
            'body' => $question->body,
            'answers' => $question->answers,
        ]);
    }

    // Update Question Data
    public function update(Question $question, Request $request) {
        $fields = $request->validate([
            'body' => 'string|required',
            'answers' => 'array|required',
            'answers.*.body' => 'string|required',
            'answers.*.result' => 'string|required',
        ]);

        $correctAnswersCount = count(Arr::where($request->answers, function ($value, $key) {
            return $value['result'] != 0;
        }));

        if ($correctAnswersCount == 0) {
            return redirect()->back()->with('status', 'error')->with('message', 'You must have at least one correct answer!')->with('answers', $fields['answers']);
        }

        if ($request->type == 'redio' && $correctAnswersCount > 1) {
            return redirect()->back()->with('status', 'error')->with('message', 'You can have only one correct answer for question of type `radio`!')->with('answers', $fields['answers']);
        }

        // Update Question
        $question->body = $fields['body'];
        $question->save();

        // Delete old answers
        $question->answers()->delete();

        // Add new answers
        foreach ($fields['answers'] as $answerData) {
            $answer = new Answer();
            $answer->body = $answerData['body'];
            $answer->result = $answerData['result'];
            $answer->question_id = $question['id'];
            $answer->save();
        }
        
        return redirect('/questions')->with('status', 'success')->with('message', 'Question updated successfully!');
    }

}
