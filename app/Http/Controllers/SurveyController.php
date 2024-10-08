<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Http\Resources\QuestionResource;
use App\Models\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surveys = Survey::query()
            ->select('id', 'title', 'description', 'created_at', 'updated_at', 'user_id')
            ->where('user_id', auth()->id())
            ->paginate(10)
            ->onEachSide(1);
        #$surveys = $query->paginate(10)->onEachSide(1);
        return inertia("Survey/SurveyList", [
            "surveys" => SurveyResource::collection($surveys),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Survey/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $survey = Survey::create($data);


        $request->session()->flash('success', 'Survey created successfully!');
        return to_route('surveys.index', $survey);
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        if (auth()->user()->cannot('view', $survey)) {
            abort(403);
        }

        $questions = $survey->questions()->get();

        return inertia("Survey/Survey", [
            "survey" => new SurveyResource($survey),
            "questions" => QuestionResource::collection($questions),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        return inertia("Survey/Edit", [
            "survey" => new SurveyResource($survey),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        if ($request->user()->cannot('update', $survey)) {
            abort(403);
        }

        $validated = $request->validated();


        $survey->update($validated);

        $request->session()->flash('success', 'Survey updated successfully!');
        return to_route('surveys.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        if(auth()->user()->cannot('delete', $survey)) {
            abort(403);
        }
        $survey->delete();

        request()->session()->flash('success', 'Survey deleted successfully!');
        return to_route('surveys.index');
        
    }
}