<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class CourseController extends Controller
{
    #[OA\Get(
        path: '/courses',
        summary: 'Listar cursos ativos',
        description: 'Retorna todos os cursos ativos com seus módulos, competências e informações de decisão',
        tags: ['Cursos'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de cursos ativos',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Course')
                )
            )
        ]
    )]
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

    #[OA\Get(
        path: '/courses/featured',
        summary: 'Listar cursos em destaque',
        description: 'Retorna todos os cursos marcados como destaque e ativos',
        tags: ['Cursos'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de cursos em destaque',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Course')
                )
            )
        ]
    )]
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

    #[OA\Get(
        path: '/courses/{course}',
        summary: 'Exibir curso específico',
        description: 'Retorna os detalhes de um curso específico com seus módulos, competências e informações de decisão',
        tags: ['Cursos'],
        parameters: [
            new OA\Parameter(
                name: 'course',
                description: 'ID do curso',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Detalhes do curso',
                content: new OA\JsonContent(ref: '#/components/schemas/Course')
            ),
            new OA\Response(
                response: 404,
                description: 'Curso não encontrado'
            )
        ]
    )]
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

    #[OA\Post(
        path: '/courses',
        summary: 'Criar novo curso',
        description: 'Cria um novo curso com os dados fornecidos',
        tags: ['Cursos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['name', 'description', 'owner'],
                    properties: [
                        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Nome do curso'),
                        new OA\Property(property: 'description', type: 'string', description: 'Descrição do curso'),
                        new OA\Property(property: 'type', type: 'string', maxLength: 255, description: 'Tipo do curso'),
                        new OA\Property(property: 'main_category', type: 'string', maxLength: 255, description: 'Categoria principal'),
                        new OA\Property(property: 'duration_hours', type: 'integer', minimum: 1, description: 'Duração em horas'),
                        new OA\Property(property: 'modules_count', type: 'integer', minimum: 1, description: 'Número de módulos'),
                        new OA\Property(property: 'access_period_months', type: 'integer', minimum: 1, description: 'Período de acesso em meses'),
                        new OA\Property(property: 'modality', type: 'string', maxLength: 255, description: 'Modalidade'),
                        new OA\Property(property: 'price', type: 'number', format: 'decimal', minimum: 0, description: 'Preço'),
                        new OA\Property(property: 'enrollment_fee', type: 'number', format: 'decimal', minimum: 0, description: 'Taxa de matrícula'),
                        new OA\Property(property: 'max_installments', type: 'integer', minimum: 1, description: 'Máximo de parcelas'),
                        new OA\Property(property: 'installment_value', type: 'number', format: 'decimal', minimum: 0, description: 'Valor da parcela'),
                        new OA\Property(property: 'featured', type: 'boolean', description: 'Curso em destaque'),
                        new OA\Property(property: 'active', type: 'boolean', description: 'Curso ativo'),
                        new OA\Property(property: 'target_audience', type: 'string', description: 'Público-alvo'),
                        new OA\Property(property: 'payment_info', type: 'string', description: 'Informações de pagamento'),
                        new OA\Property(property: 'payment_conditions', type: 'string', description: 'Condições de pagamento'),
                        new OA\Property(property: 'instructor', type: 'string', maxLength: 255, description: 'Instrutor'),
                        new OA\Property(property: 'level', type: 'string', maxLength: 255, description: 'Nível'),
                        new OA\Property(property: 'category', type: 'string', maxLength: 255, description: 'Categoria'),
                        new OA\Property(property: 'owner', type: 'string', maxLength: 255, description: 'Proprietário'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary', description: 'Imagem do curso'),
                        new OA\Property(property: 'banner', type: 'string', format: 'binary', description: 'Banner do curso')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Curso criado com sucesso',
                content: new OA\JsonContent(ref: '#/components/schemas/Course')
            ),
            new OA\Response(
                response: 422,
                description: 'Erro de validação',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string'),
                        new OA\Property(property: 'errors', type: 'object')
                    ]
                )
            )
        ]
    )]
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
            'featured' => 'nullable|string|in:true,false,0,1',
            'active' => 'nullable|string|in:true,false,0,1',
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

        // Converter valores boolean vindos de multipart/form-data
        if (isset($courseData['featured'])) {
            $courseData['featured'] = $courseData['featured'] === 'true' || $courseData['featured'] === '1' || $courseData['featured'] === 1 || $courseData['featured'] === true;
        }
        if (isset($courseData['active'])) {
            $courseData['active'] = $courseData['active'] === 'true' || $courseData['active'] === '1' || $courseData['active'] === 1 || $courseData['active'] === true;
        }

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

    #[OA\Put(
        path: '/courses/{course}',
        summary: 'Atualizar curso',
        description: 'Atualiza os dados de um curso existente',
        tags: ['Cursos'],
        parameters: [
            new OA\Parameter(
                name: 'course',
                description: 'ID do curso',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'name', type: 'string', maxLength: 255, description: 'Nome do curso'),
                        new OA\Property(property: 'description', type: 'string', description: 'Descrição do curso'),
                        new OA\Property(property: 'type', type: 'string', maxLength: 255, description: 'Tipo do curso'),
                        new OA\Property(property: 'main_category', type: 'string', maxLength: 255, description: 'Categoria principal'),
                        new OA\Property(property: 'duration_hours', type: 'integer', minimum: 1, description: 'Duração em horas'),
                        new OA\Property(property: 'modules_count', type: 'integer', minimum: 1, description: 'Número de módulos'),
                        new OA\Property(property: 'access_period_months', type: 'integer', minimum: 1, description: 'Período de acesso em meses'),
                        new OA\Property(property: 'modality', type: 'string', maxLength: 255, description: 'Modalidade'),
                        new OA\Property(property: 'price', type: 'number', format: 'decimal', minimum: 0, description: 'Preço'),
                        new OA\Property(property: 'enrollment_fee', type: 'number', format: 'decimal', minimum: 0, description: 'Taxa de matrícula'),
                        new OA\Property(property: 'max_installments', type: 'integer', minimum: 1, description: 'Máximo de parcelas'),
                        new OA\Property(property: 'installment_value', type: 'number', format: 'decimal', minimum: 0, description: 'Valor da parcela'),
                        new OA\Property(property: 'featured', type: 'boolean', description: 'Curso em destaque'),
                        new OA\Property(property: 'active', type: 'boolean', description: 'Curso ativo'),
                        new OA\Property(property: 'target_audience', type: 'string', description: 'Público-alvo'),
                        new OA\Property(property: 'payment_info', type: 'string', description: 'Informações de pagamento'),
                        new OA\Property(property: 'payment_conditions', type: 'string', description: 'Condições de pagamento'),
                        new OA\Property(property: 'instructor', type: 'string', maxLength: 255, description: 'Instrutor'),
                        new OA\Property(property: 'level', type: 'string', maxLength: 255, description: 'Nível'),
                        new OA\Property(property: 'category', type: 'string', maxLength: 255, description: 'Categoria'),
                        new OA\Property(property: 'owner', type: 'string', maxLength: 255, description: 'Proprietário'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary', description: 'Imagem do curso'),
                        new OA\Property(property: 'banner', type: 'string', format: 'binary', description: 'Banner do curso')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Curso atualizado com sucesso',
                content: new OA\JsonContent(ref: '#/components/schemas/Course')
            ),
            new OA\Response(
                response: 404,
                description: 'Curso não encontrado'
            ),
            new OA\Response(
                response: 422,
                description: 'Erro de validação',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string'),
                        new OA\Property(property: 'errors', type: 'object')
                    ]
                )
            )
        ]
    )]
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
            'featured' => 'nullable|string|in:true,false,0,1',
            'active' => 'nullable|string|in:true,false,0,1',
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

        // Converter valores boolean vindos de multipart/form-data
        if (isset($courseData['featured'])) {
            $courseData['featured'] = $courseData['featured'] === 'true' || $courseData['featured'] === '1' || $courseData['featured'] === 1 || $courseData['featured'] === true;
        }
        if (isset($courseData['active'])) {
            $courseData['active'] = $courseData['active'] === 'true' || $courseData['active'] === '1' || $courseData['active'] === 1 || $courseData['active'] === true;
        }

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

    #[OA\Delete(
        path: '/courses/{course}',
        summary: 'Excluir curso',
        description: 'Remove um curso do sistema',
        tags: ['Cursos'],
        parameters: [
            new OA\Parameter(
                name: 'course',
                description: 'ID do curso',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Curso excluído com sucesso',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string')
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Curso não encontrado'
            )
        ]
    )]
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