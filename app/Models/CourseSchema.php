<?php

namespace App\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Course",
    title: "Curso",
    description: "Modelo de dados para cursos",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "ID único do curso"),
        new OA\Property(property: "name", type: "string", maxLength: 255, description: "Nome do curso"),
        new OA\Property(property: "description", type: "string", description: "Descrição detalhada do curso"),
        new OA\Property(property: "type", type: "string", maxLength: 255, description: "Tipo do curso"),
        new OA\Property(property: "main_category", type: "string", maxLength: 255, description: "Categoria principal"),
        new OA\Property(property: "duration_hours", type: "integer", description: "Duração em horas"),
        new OA\Property(property: "modules_count", type: "integer", description: "Número de módulos"),
        new OA\Property(property: "access_period_months", type: "integer", description: "Período de acesso em meses"),
        new OA\Property(property: "modality", type: "string", maxLength: 255, description: "Modalidade do curso"),
        new OA\Property(property: "price", type: "number", format: "decimal", description: "Preço do curso"),
        new OA\Property(property: "enrollment_fee", type: "number", format: "decimal", description: "Taxa de matrícula"),
        new OA\Property(property: "max_installments", type: "integer", description: "Máximo de parcelas"),
        new OA\Property(property: "installment_value", type: "number", format: "decimal", description: "Valor da parcela"),
        new OA\Property(property: "featured", type: "boolean", description: "Curso em destaque"),
        new OA\Property(property: "active", type: "boolean", description: "Curso ativo"),
        new OA\Property(property: "target_audience", type: "string", description: "Público-alvo"),
        new OA\Property(property: "payment_info", type: "string", description: "Informações de pagamento"),
        new OA\Property(property: "payment_conditions", type: "string", description: "Condições de pagamento"),
        new OA\Property(property: "instructor", type: "string", maxLength: 255, description: "Instrutor"),
        new OA\Property(property: "level", type: "string", maxLength: 255, description: "Nível do curso"),
        new OA\Property(property: "category", type: "string", maxLength: 255, description: "Categoria"),
        new OA\Property(property: "owner", type: "string", maxLength: 255, description: "Proprietário"),
        new OA\Property(property: "image", type: "string", description: "Caminho da imagem"),
        new OA\Property(property: "banner", type: "string", description: "Caminho do banner"),
        new OA\Property(property: "image_url", type: "string", description: "URL completa da imagem"),
        new OA\Property(property: "banner_url", type: "string", description: "URL completa do banner"),
        new OA\Property(property: "created_at", type: "string", format: "date-time", description: "Data de criação"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", description: "Data de última atualização"),
        new OA\Property(
            property: "modules",
            type: "array",
            description: "Módulos do curso",
            items: new OA\Items(ref: "#/components/schemas/CourseModule")
        ),
        new OA\Property(
            property: "competencies",
            type: "array",
            description: "Competências do curso",
            items: new OA\Items(ref: "#/components/schemas/Competency")
        ),
        new OA\Property(
            property: "decision_infos",
            type: "array",
            description: "Informações de decisão",
            items: new OA\Items(ref: "#/components/schemas/DecisionInfo")
        )
    ]
)]
class CourseSchema
{
    // Esta classe serve apenas para definir o schema OpenAPI
}

#[OA\Schema(
    schema: "CourseModule",
    title: "Módulo do Curso",
    description: "Modelo de dados para módulos de curso",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "ID único do módulo"),
        new OA\Property(property: "course_id", type: "integer", description: "ID do curso"),
        new OA\Property(property: "name", type: "string", description: "Nome do módulo"),
        new OA\Property(property: "description", type: "string", description: "Descrição do módulo"),
        new OA\Property(property: "order", type: "integer", description: "Ordem do módulo"),
        new OA\Property(property: "created_at", type: "string", format: "date-time", description: "Data de criação"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", description: "Data de última atualização")
    ]
)]
class CourseModuleSchema
{
    // Esta classe serve apenas para definir o schema OpenAPI
}

#[OA\Schema(
    schema: "Competency",
    title: "Competência",
    description: "Modelo de dados para competências",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "ID único da competência"),
        new OA\Property(property: "course_id", type: "integer", description: "ID do curso"),
        new OA\Property(property: "name", type: "string", description: "Nome da competência"),
        new OA\Property(property: "description", type: "string", description: "Descrição da competência"),
        new OA\Property(property: "order", type: "integer", description: "Ordem da competência"),
        new OA\Property(property: "created_at", type: "string", format: "date-time", description: "Data de criação"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", description: "Data de última atualização")
    ]
)]
class CompetencySchema
{
    // Esta classe serve apenas para definir o schema OpenAPI
}

#[OA\Schema(
    schema: "DecisionInfo",
    title: "Informação de Decisão",
    description: "Modelo de dados para informações de decisão",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "ID único da informação"),
        new OA\Property(property: "course_id", type: "integer", description: "ID do curso"),
        new OA\Property(property: "type", type: "string", description: "Tipo da informação"),
        new OA\Property(property: "content", type: "string", description: "Conteúdo da informação"),
        new OA\Property(property: "order", type: "integer", description: "Ordem da informação"),
        new OA\Property(property: "created_at", type: "string", format: "date-time", description: "Data de criação"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", description: "Data de última atualização")
    ]
)]
class DecisionInfoSchema
{
    // Esta classe serve apenas para definir o schema OpenAPI
}