# 🎓 Landing Page Cursos - API

API REST desenvolvida em **Laravel 11** para gerenciar cursos e competências.

## 📋 Sumário

- [🚀 Tecnologias](#-tecnologias)
- [⚡ Funcionalidades](#-funcionalidades)
- [💻 Requisitos](#-requisitos)
- [🛠️ Instalação](#%EF%B8%8F-instalação)
- [📚 API](#-api)
- [📖 Documentação](#-documentação)
- [🗂️ Estrutura](#%EF%B8%8F-estrutura)

## 🚀 Tecnologias

- **PHP 8.2** com Laravel 11
- **PostgreSQL 15** (banco de dados)
- **Apache 2.4** (servidor web)
- **Docker & Docker Compose** (containerização)

## ⚡ Funcionalidades

✅ **CRUD completo de cursos**
✅ **Upload de imagens** (curso e banner)
✅ **Cursos em destaque**
✅ **API RESTful**
✅ **Relacionamentos** (módulos, competências)

## 💻 Requisitos

- **Docker** 20.0+
- **Docker Compose** 2.0+
- **Git**

## 🛠️ Instalação

### 1️⃣ Clone o repositório
```bash
git clone https://github.com/joaovitornunes09/landing-page-cursos-back.git
cd landing-page-cursos-back
```

### 2️⃣ Configure o ambiente
```bash
cp .env.example .env
```

### 3️⃣ Inicie a aplicação
```bash
docker-compose up -d
```

### 4️⃣ Acesse a API
🌐 **http://localhost:8005**

---

### ⚙️ Comandos úteis

```bash
# Parar aplicação
docker-compose down

# Ver logs
docker logs cursos-backend -f

# Recriar containers
docker-compose up -d --build

# Executar comandos Laravel
docker exec cursos-backend php artisan migrate
docker exec cursos-backend php artisan cache:clear
```

> **💡 Dica:** A aplicação já vem configurada! O Docker automaticamente:
> - Gera a `APP_KEY`
> - Configura permissões
> - Executa migrations
> - Popula dados iniciais

## 📚 API

### 🔗 Base URL
```
http://localhost:8005/api
```

### 📋 Principais Endpoints

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/courses` | Lista todos os cursos |
| `GET` | `/courses/featured` | Lista cursos em destaque |
| `GET` | `/courses/{id}` | Detalhes de um curso |
| `POST` | `/courses` | Criar novo curso |
| `PUT` | `/courses/{id}` | Atualizar curso |
| `DELETE` | `/courses/{id}` | Deletar curso |

## 📖 Documentação

### 🔍 Swagger/OpenAPI

A API possui documentação interativa completa usando **Swagger/OpenAPI 3.0**:

**🌐 Acesse a documentação:**
```
http://localhost:8005/api/documentation
```

### 📋 Funcionalidades da Documentação

✅ **Interface interativa** - Teste endpoints diretamente
✅ **Schemas detalhados** - Estrutura completa dos dados
✅ **Exemplos de requisição** - Para todos os endpoints
✅ **Validações documentadas** - Regras e tipos de dados
✅ **Códigos de resposta** - Status codes e estruturas

### 📂 Endpoints Documentados

- 📚 **Cursos** - CRUD completo com upload de arquivos
- 🏷️ **Módulos** - Relacionamentos e ordenação
- 🎯 **Competências** - Estrutura hierárquica
- ℹ️ **Informações de Decisão** - Dados complementares

### 🔄 Regenerar Documentação

```bash
# Regenerar a documentação após mudanças
docker exec cursos-backend php artisan l5-swagger:generate
```

## 🗂️ Estrutura

```
├── app/
│   ├── Http/Controllers/Api/
│   │   └── CourseController.php    # API de cursos
│   └── Models/
│       ├── Course.php              # Model principal
│       ├── CourseModule.php        # Módulos
│       ├── Competency.php          # Competências
│       └── DecisionInfo.php        # Informações
├── database/migrations/            # Migrações
├── routes/api.php                  # Rotas da API
├── docker-compose.yml              # Configuração Docker
└── Dockerfile                      # Container customizado
```

## 🔧 Configurações Automáticas

A aplicação já resolve automaticamente:

✅ **APP_KEY** - Gerada automaticamente
✅ **Permissões** - Configuradas no container
✅ **Migrations** - Executadas na inicialização
✅ **Storage Link** - Criado automaticamente
