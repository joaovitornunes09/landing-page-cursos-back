<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\DecisionInfo;
use App\Models\Competency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $course1 = Course::create([
            'name' => 'Secretaria Escolar',
            'description' => 'O(a) profissional em Secretaria Escolar é peça-chave para a gestão eficiente da escola, garantindo o funcionamento legal e organizado da instituição. Responsável por gerenciar a documentação dos estudantes, ele(a) também contribui para o alinhamento do currículo escolar com as necessidades reais dos alunos. Seja essencial para o sucesso da escola e para a formação de um ambiente educacional estruturado. Invista na sua capacitação e faça a diferença na gestão escolar!',
            'type' => 'TÉCNICO',
            'main_category' => 'TECNOLOGIA E PROFISSÃO',
            'duration_hours' => 1500,
            'modules_count' => 7,
            'access_period_months' => 15,
            'modality' => 'EAD',
            'price' => 2835.30,
            'enrollment_fee' => 70.00,
            'max_installments' => 15,
            'installment_value' => 189.02,
            'featured' => true,
            'active' => true,
            'target_audience' => 'Estudantes que concluíram o ensino médio e profissionais que desejam atualizar conhecimentos na área de tecnologia.',
            'payment_info' => 'Matrícula: R$ 70,00 + 15 parcelas de R$ 189,02',
            'payment_conditions' => 'Pagamento por cartão de crédito, débito ou boleto bancário. Primeira parcela no ato da matrícula.',
            'instructor' => 'Prof. João Silva',
            'level' => 'Técnico',
            'category' => 'Tecnologia E PROFISSÃO',
            'owner' => 'O POVO',
            'image' => 'courses/images/secretaria-escolar.png',
            'banner' => 'courses/banners/secretaria-escolar.png'
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Secretaria escolar',
            'description' => 'Fundamentos da secretaria escolar: funções, responsabilidades, rotina administrativa e sua importância para o bom funcionamento da instituição de ensino.',
            'order' => 1
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Redação oficial e informática',
            'description' => 'Práticas de redação de documentos oficiais, normas da escrita administrativa e uso de ferramentas básicas de informática aplicadas ao ambiente escolar.',
            'order' => 2
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Estatística básica e indicadores educacionais',
            'description' => 'Noções de estatística aplicada à educação, coleta e interpretação de dados escolares, e análise de indicadores de desempenho dos alunos e da instituição.',
            'order' => 3
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Planejamento, gestão e legislação educacional',
            'description' => 'Princípios da gestão escolar, políticas públicas em educação, legislação vigente e papel do secretário escolar na conformidade legal da instituição.',
            'order' => 4
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Funcionamento e organização da secretaria escolar',
            'description' => 'Estrutura e rotinas da secretaria: matrícula, transferências, emissão de documentos, arquivamento e atendimento à comunidade escolar.',
            'order' => 5
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Legislação educacional',
            'description' => 'Estudo aprofundado das normas e diretrizes que regem a educação brasileira, incluindo LDB, normas do MEC e regulamentações estaduais e municipais.',
            'order' => 6
        ]);

        CourseModule::create([
            'course_id' => $course1->id,
            'title' => 'Estágio supervisionado',
            'description' => 'Vivência prática das atividades de secretaria escolar em ambiente real, integrando os conhecimentos adquiridos e desenvolvendo competências profissionais.',
            'order' => 7
        ]);

        Competency::create([
            'course_id' => $course1->id,
            'description' => 'Elaborar, organizar e arquivar documentos escolares de acordo com as normas legais.',
            'order' => 1
        ]);

        Competency::create([
            'course_id' => $course1->id,
            'description' => 'Utilizar adequadamente a redação oficial e ferramentas de informática aplicadas à rotina escolar.',
            'order' => 2
        ]);

        Competency::create([
            'course_id' => $course1->id,
            'description' => 'Interpretar e aplicar a legislação educacional vigente no âmbito da secretaria escolar.',
            'order' => 3
        ]);

        Competency::create([
            'course_id' => $course1->id,
            'description' => 'Gerenciar matrículas, transferências, históricos e demais registros acadêmicos com precisão e segurança.',
            'order' => 4
        ]);

        Competency::create([
            'course_id' => $course1->id,
            'description' => 'Atender pais, alunos e comunidade escolar de forma ética, clara e eficiente, contribuindo para a gestão da instituição.',
            'order' => 5
        ]);

        DecisionInfo::create([
            'course_id' => $course1->id,
            'title' => 'Público-Alvo',
            'content' => 'Estudantes que concluíram o ensino médio e desejam atuar em instituições de ensino, além de profissionais da área administrativa escolar que buscam atualização e aperfeiçoamento.',
            'type' => 'target_audience',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course1->id,
            'title' => 'Informações de Pagamento',
            'content' => 'Matrícula: R$ 70,00 + 15 parcelas de R$ 189,02. Total do curso: R$ 2.905,30',
            'type' => 'payment_info',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course1->id,
            'title' => 'Condições de Pagamento',
            'content' => 'Pagamento por cartão de crédito, débito ou boleto bancário. Primeira parcela no ato da matrícula. Desconto de 10% para pagamento à vista.',
            'type' => 'payment_conditions',
            'order' => 1
        ]);

        $course2 = Course::create([
            'name' => 'Educação Ambiental para um Presente Sustentável',
            'description' => 'Compreenda os fundamentos da educação ambiental e sua aplicação no contexto atual. Este curso oferece conhecimentos teóricos e práticos sobre sustentabilidade, conservação dos recursos naturais e desenvolvimento de políticas ambientais. Ideal para educadores, gestores públicos e profissionais que desejam promover práticas sustentáveis em suas comunidades e organizações.',
            'type' => 'EXTENSÃO',
            'main_category' => 'BEM-VIVER',
            'duration_hours' => 40,
            'modules_count' => 5,
            'access_period_months' => 6,
            'modality' => 'EAD',
            'price' => 350.00,
            'enrollment_fee' => 30.00,
            'max_installments' => 3,
            'installment_value' => 106.67,
            'featured' => false,
            'active' => true,
            'target_audience' => 'Educadores, gestores públicos, profissionais da área ambiental e cidadãos interessados em sustentabilidade.',
            'payment_info' => 'Matrícula: R$ 30,00 + 3 parcelas de R$ 106,67',
            'payment_conditions' => 'Pagamento por cartão de crédito, débito ou boleto bancário. Desconto de 10% para pagamento à vista.',
            'instructor' => 'Dr. Marina Santos',
            'level' => 'Básico',
            'category' => 'Meio Ambiente',
            'owner' => 'Fundação Demócrito Rocha',
            'image' => 'courses/images/educacao-ambiental-para-um-presente-sustentavel.png',
            'banner' => 'courses/banners/educacao-ambiental-para-um-presente-sustentavel.png'
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Fundamentos da Educação Ambiental',
            'description' => 'Conceitos básicos, histórico e princípios da educação ambiental.',
            'order' => 1
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Sustentabilidade e Desenvolvimento',
            'description' => 'Conceitos de desenvolvimento sustentável e práticas ecológicas.',
            'order' => 2
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Recursos Naturais e Conservação',
            'description' => 'Gestão sustentável dos recursos naturais e técnicas de conservação.',
            'order' => 3
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Práticas Educativas Ambientais',
            'description' => 'Metodologias e ferramentas para educação ambiental.',
            'order' => 4
        ]);

        CourseModule::create([
            'course_id' => $course2->id,
            'title' => 'Projeto de Ação Ambiental',
            'description' => 'Desenvolvimento e implementação de projetos sustentáveis.',
            'order' => 5
        ]);

        Competency::create([
            'course_id' => $course2->id,
            'description' => 'Aplicar conceitos de sustentabilidade em ações cotidianas.',
            'order' => 1
        ]);

        Competency::create([
            'course_id' => $course2->id,
            'description' => 'Desenvolver projetos de educação ambiental.',
            'order' => 2
        ]);

        Competency::create([
            'course_id' => $course2->id,
            'description' => 'Promover práticas de conservação ambiental.',
            'order' => 3
        ]);

        Competency::create([
            'course_id' => $course2->id,
            'description' => 'Sensibilizar comunidades sobre questões ambientais.',
            'order' => 4
        ]);

        Competency::create([
            'course_id' => $course2->id,
            'description' => 'Implementar políticas ambientais em organizações.',
            'order' => 5
        ]);

        DecisionInfo::create([
            'course_id' => $course2->id,
            'title' => 'Público-Alvo',
            'content' => 'Educadores, gestores públicos e profissionais interessados em educação ambiental.',
            'type' => 'target_audience',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course2->id,
            'title' => 'Informações de Pagamento',
            'content' => 'Matrícula: R$ 30,00 + 3 parcelas de R$ 106,67. Total: R$ 350,00',
            'type' => 'payment_info',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course2->id,
            'title' => 'Condições de Pagamento',
            'content' => 'Pagamento por cartão de crédito, débito ou boleto. Desconto de 10% para pagamento à vista.',
            'type' => 'payment_conditions',
            'order' => 1
        ]);

        $course3 = Course::create([
            'name' => 'Como Implementar a Política Municipal de Educação Ambiental',
            'description' => 'Aprenda a desenvolver e implementar políticas municipais de educação ambiental eficazes. Este curso oferece ferramentas práticas para gestores públicos criarem programas sustentáveis, alinhados à legislação ambiental. Desenvolva competências para coordenar projetos educacionais ambientais e promover a conscientização ecológica na sua cidade.',
            'type' => 'CURTA DURAÇÃO',
            'main_category' => 'TECNOLOGIA E PROFISSÃO',
            'duration_hours' => 180,
            'modules_count' => 8,
            'access_period_months' => 12,
            'modality' => 'EAD',
            'price' => 1200.00,
            'enrollment_fee' => 50.00,
            'max_installments' => 6,
            'installment_value' => 191.67,
            'featured' => false,
            'active' => true,
            'target_audience' => 'Gestores públicos, secretários municipais de meio ambiente, educadores e profissionais da gestão pública.',
            'payment_info' => 'Matrícula: R$ 50,00 + 6 parcelas de R$ 191,67',
            'payment_conditions' => 'Cartão, boleto ou débito. Desconto de 15% à vista.',
            'instructor' => 'Daniel Pagliuca',
            'level' => 'Avançado',
            'category' => 'Gestão Pública',
            'owner' => 'Daniel Pagliuca',
            'image' => 'courses/images/politica-municipal-educacao-ambiental.png',
            'banner' => 'courses/banners/politica-municipal-educacao-ambiental.png'
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Marco Legal da Educação Ambiental',
            'description' => 'Legislação federal, estadual e municipal sobre educação ambiental.',
            'order' => 1
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Diagnóstico Ambiental Municipal',
            'description' => 'Metodologias para avaliação da situação ambiental local.',
            'order' => 2
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Elaboração de Políticas Públicas',
            'description' => 'Técnicas para criação de políticas municipais eficazes.',
            'order' => 3
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Participação Social e Conselhos',
            'description' => 'Mobilização social e gestão participativa em projetos ambientais.',
            'order' => 4
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Financiamento e Recursos',
            'description' => 'Captação de recursos para programas de educação ambiental.',
            'order' => 5
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Monitoramento e Avaliação',
            'description' => 'Indicadores e métodos de avaliação de políticas ambientais.',
            'order' => 6
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Implementação e Execução',
            'description' => 'Estratégias para colocar políticas ambientais em prática.',
            'order' => 7
        ]);

        CourseModule::create([
            'course_id' => $course3->id,
            'title' => 'Projeto Final',
            'description' => 'Desenvolvimento de uma política municipal de educação ambiental.',
            'order' => 8
        ]);

        Competency::create([
            'course_id' => $course3->id,
            'description' => 'Elaborar políticas públicas de educação ambiental.',
            'order' => 1
        ]);

        Competency::create([
            'course_id' => $course3->id,
            'description' => 'Coordenar programas de educação ambiental municipal.',
            'order' => 2
        ]);

        Competency::create([
            'course_id' => $course3->id,
            'description' => 'Implementar ações de mobilização social ambiental.',
            'order' => 3
        ]);

        Competency::create([
            'course_id' => $course3->id,
            'description' => 'Avaliar e monitorar políticas ambientais locais.',
            'order' => 4
        ]);

        Competency::create([
            'course_id' => $course3->id,
            'description' => 'Captar recursos para projetos de educação ambiental.',
            'order' => 5
        ]);

        DecisionInfo::create([
            'course_id' => $course3->id,
            'title' => 'Público-Alvo',
            'content' => 'Gestores públicos, secretários municipais e profissionais da gestão ambiental.',
            'type' => 'target_audience',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course3->id,
            'title' => 'Informações de Pagamento',
            'content' => 'Matrícula: R$ 50,00 + 6 parcelas de R$ 191,67. Total: R$ 1.200,00',
            'type' => 'payment_info',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course3->id,
            'title' => 'Condições de Pagamento',
            'content' => 'Pagamento em cartão, débito ou boleto. 15% de desconto à vista.',
            'type' => 'payment_conditions',
            'order' => 1
        ]);

        $course4 = Course::create([
            'name' => 'Bullying: conhecer para combater',
            'description' => 'Identifique, previna e combata o bullying em ambientes educacionais. Este curso oferece conhecimentos teóricos e práticas eficazes para educadores, pais e profissionais da educação lidarem com situações de bullying. Aprenda estratégias de intervenção, métodos de prevenção e técnicas para criar ambientes escolares mais seguros e acolhedores para todos os estudantes.',
            'type' => 'CURTA DURAÇÃO',
            'main_category' => 'BEM-VIVER',
            'duration_hours' => 60,
            'modules_count' => 6,
            'access_period_months' => 8,
            'modality' => 'EAD',
            'price' => 480.00,
            'enrollment_fee' => 40.00,
            'max_installments' => 4,
            'installment_value' => 110.00,
            'featured' => false,
            'active' => true,
            'target_audience' => 'Educadores, psicólogos escolares, pais, coordenadores pedagógicos e profissionais da área da educação.',
            'payment_info' => 'Matrícula: R$ 40,00 + 4 parcelas de R$ 110,00',
            'payment_conditions' => 'Pagamento em cartão, débito ou boleto. 10% de desconto à vista.',
            'instructor' => 'Grecianny Carvalho',
            'level' => 'Intermediário',
            'category' => 'Educação',
            'owner' => 'Grecianny Carvalho',
            'image' => 'courses/images/bullying-conhecer-para-combater.png',
            'banner' => 'courses/banners/bullying-conhecer-para-combater.png'
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Fundamentos da Administração',
            'description' => 'Princípios e teorias administrativas.',
            'order' => 1
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Gestão de Pessoas',
            'description' => 'Práticas de recrutamento, seleção e desenvolvimento de equipes.',
            'order' => 2
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Gestão Financeira',
            'description' => 'Planejamento e controle financeiro organizacional.',
            'order' => 3
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Marketing e Vendas',
            'description' => 'Princípios de marketing e estratégias comerciais.',
            'order' => 4
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Gestão de Processos',
            'description' => 'Organização e melhoria de processos internos.',
            'order' => 5
        ]);

        CourseModule::create([
            'course_id' => $course4->id,
            'title' => 'Estágio Supervisionado',
            'description' => 'Vivência prática em ambientes administrativos.',
            'order' => 6
        ]);

        Competency::create([
            'course_id' => $course4->id,
            'description' => 'Apoiar processos de gestão administrativa.',
            'order' => 1
        ]);

        Competency::create([
            'course_id' => $course4->id,
            'description' => 'Organizar rotinas e documentos administrativos.',
            'order' => 2
        ]);

        Competency::create([
            'course_id' => $course4->id,
            'description' => 'Auxiliar no planejamento e controle financeiro.',
            'order' => 3
        ]);

        Competency::create([
            'course_id' => $course4->id,
            'description' => 'Aplicar técnicas de gestão de pessoas e atendimento.',
            'order' => 4
        ]);

        Competency::create([
            'course_id' => $course4->id,
            'description' => 'Contribuir para estratégias de marketing e vendas.',
            'order' => 5
        ]);

        DecisionInfo::create([
            'course_id' => $course4->id,
            'title' => 'Público-Alvo',
            'content' => 'Estudantes e profissionais que buscam carreira na área administrativa.',
            'type' => 'target_audience',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course4->id,
            'title' => 'Informações de Pagamento',
            'content' => 'Matrícula: R$ 70,00 + 10 parcelas de R$ 243,00. Total: R$ 2.500,00',
            'type' => 'payment_info',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course4->id,
            'title' => 'Condições de Pagamento',
            'content' => 'Cartão, débito ou boleto. 10% de desconto para pagamento à vista.',
            'type' => 'payment_conditions',
            'order' => 1
        ]);

        $course5 = Course::create([
            'name' => 'Gestão Fiscal Interfederativa',
            'description' => 'O curso de Técnico em Informática capacita profissionais para atuar no desenvolvimento, manutenção e suporte a sistemas computacionais, redes e aplicativos, com foco em soluções práticas para empresas e usuários finais.',
            'type' => 'EXTENSÃO',
            'main_category' => 'BEM-VIVER',
            'duration_hours' => 1200,
            'modules_count' => 6,
            'access_period_months' => 14,
            'modality' => 'EAD',
            'price' => 2900.00,
            'enrollment_fee' => 90.00,
            'max_installments' => 12,
            'installment_value' => 234.00,
            'featured' => true,
            'active' => true,
            'target_audience' => 'Estudantes que concluíram o ensino médio e desejam ingressar na área de tecnologia da informação.',
            'payment_info' => 'Matrícula: R$ 90,00 + 12 parcelas de R$ 234,00',
            'payment_conditions' => 'Pagamento via cartão, débito ou boleto. Desconto de 10% à vista.',
            'instructor' => 'Prof. Lucas Ferreira',
            'level' => 'Técnico',
            'category' => 'Tecnologia',
            'owner' => 'Fundação Demócrito Rocha',
            'image' => 'courses/images/gestao-fiscal-interfederativa.png',
            'banner' => 'courses/banners/gestao-fiscal-interfederativa.png'
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Fundamentos de Informática',
            'description' => 'História, conceitos e fundamentos da computação.',
            'order' => 1
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Programação e Algoritmos',
            'description' => 'Lógica de programação e linguagens básicas.',
            'order' => 2
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Banco de Dados',
            'description' => 'Modelagem, implementação e consultas SQL.',
            'order' => 3
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Redes de Computadores',
            'description' => 'Conceitos de redes locais e cabeamento estruturado.',
            'order' => 4
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Desenvolvimento Web',
            'description' => 'Introdução a HTML, CSS e JavaScript.',
            'order' => 5
        ]);

        CourseModule::create([
            'course_id' => $course5->id,
            'title' => 'Estágio Supervisionado',
            'description' => 'Experiência prática em projetos de TI.',
            'order' => 6
        ]);

        Competency::create([
            'course_id' => $course5->id,
            'description' => 'Desenvolver programas e aplicativos básicos.',
            'order' => 1
        ]);

        Competency::create([
            'course_id' => $course5->id,
            'description' => 'Realizar manutenção de computadores.',
            'order' => 2
        ]);

        Competency::create([
            'course_id' => $course5->id,
            'description' => 'Administrar redes locais simples.',
            'order' => 3
        ]);

        Competency::create([
            'course_id' => $course5->id,
            'description' => 'Gerenciar bancos de dados de pequeno porte.',
            'order' => 4
        ]);

        Competency::create([
            'course_id' => $course5->id,
            'description' => 'Construir sites simples e funcionais.',
            'order' => 5
        ]);

        DecisionInfo::create([
            'course_id' => $course5->id,
            'title' => 'Público-Alvo',
            'content' => 'Interessados em atuar na área de informática e tecnologia.',
            'type' => 'target_audience',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course5->id,
            'title' => 'Informações de Pagamento',
            'content' => 'Matrícula: R$ 90,00 + 12 parcelas de R$ 234,00. Total: R$ 2.898,00',
            'type' => 'payment_info',
            'order' => 1
        ]);

        DecisionInfo::create([
            'course_id' => $course5->id,
            'title' => 'Condições de Pagamento',
            'content' => 'Cartão, débito ou boleto. 10% de desconto para pagamento à vista.',
            'type' => 'payment_conditions',
            'order' => 1
        ]);
    }
}
