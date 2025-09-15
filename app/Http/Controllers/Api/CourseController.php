<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(): JsonResponse
    {
        $courses = Course::with(['modules' => function($query) {
            $query->orderBy('order');
        }, 'competencies' => function($query) {
            $query->orderBy('order');
        }, 'decisionInfos' => function($query) {
            $query->orderBy('type')->orderBy('order');
        }])
        ->where('active', true)
        ->get();

        return response()->json($courses);
    }

    public function featured(): JsonResponse
    {
        $courses = Course::with(['modules' => function($query) {
            $query->orderBy('order');
        }, 'competencies' => function($query) {
            $query->orderBy('order');
        }, 'decisionInfos' => function($query) {
            $query->orderBy('type')->orderBy('order');
        }])
        ->where('featured', true)
        ->where('active', true)
        ->get();

        return response()->json($courses);
    }

    public function show(Course $course): JsonResponse
    {
        $course->load(['modules' => function($query) {
            $query->orderBy('order');
        }, 'competencies' => function($query) {
            $query->orderBy('order');
        }, 'decisionInfos' => function($query) {
            $query->orderBy('type')->orderBy('order');
        }]);

        return response()->json($course);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'string|max:255',
            'main_category' => 'string|max:255',
            'duration_hours' => 'integer|min:1',
            'modules_count' => 'integer|min:1',
            'access_period_months' => 'integer|min:1',
            'modality' => 'string|max:255',
            'price' => 'numeric|min:0',
            'enrollment_fee' => 'numeric|min:0',
            'max_installments' => 'integer|min:1',
            'installment_value' => 'numeric|min:0',
            'featured' => 'boolean',
            'active' => 'boolean',
            'target_audience' => 'nullable|string',
            'payment_info' => 'nullable|string',
            'payment_conditions' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'level' => 'string|max:255',
            'category' => 'nullable|string|max:255',
            'owner' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $courseData = $request->except(['image', 'banner']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $courseData['image'] = $imagePath;
        }

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('courses/banners', 'public');
            $courseData['banner'] = $bannerPath;
        }

        $course = Course::create($courseData);

        $course->load(['modules', 'competencies', 'decisionInfos']);

        return response()->json($course, 201);
    }

    public function update(Request $request, Course $course): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'string',
            'type' => 'string|max:255',
            'main_category' => 'string|max:255',
            'duration_hours' => 'integer|min:1',
            'modules_count' => 'integer|min:1',
            'access_period_months' => 'integer|min:1',
            'modality' => 'string|max:255',
            'price' => 'numeric|min:0',
            'enrollment_fee' => 'numeric|min:0',
            'max_installments' => 'integer|min:1',
            'installment_value' => 'numeric|min:0',
            'featured' => 'boolean',
            'active' => 'boolean',
            'target_audience' => 'nullable|string',
            'payment_info' => 'nullable|string',
            'payment_conditions' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'level' => 'string|max:255',
            'category' => 'nullable|string|max:255',
            'owner' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $courseData = $request->except(['image', 'banner']);

        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $imagePath = $request->file('image')->store('courses/images', 'public');
            $courseData['image'] = $imagePath;
        }

        if ($request->hasFile('banner')) {
            if ($course->banner && Storage::disk('public')->exists($course->banner)) {
                Storage::disk('public')->delete($course->banner);
            }
            $bannerPath = $request->file('banner')->store('courses/banners', 'public');
            $courseData['banner'] = $bannerPath;
        }

        $course->update($courseData);

        $course->load(['modules', 'competencies', 'decisionInfos']);

        return response()->json($course);
    }

    public function destroy(Course $course): JsonResponse
    {
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        if ($course->banner && Storage::disk('public')->exists($course->banner)) {
            Storage::disk('public')->delete($course->banner);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}