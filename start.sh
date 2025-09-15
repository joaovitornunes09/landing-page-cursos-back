#!/bin/bash

echo "🚀 Iniciando aplicação..."

# Aguardar PostgreSQL
echo "⏳ Aguardando PostgreSQL..."
while ! pg_isready -h db -p 5432 -U cursos_user; do
    sleep 2
done
echo "✅ PostgreSQL conectado!"

# Criar diretórios se não existirem
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views
mkdir -p bootstrap/cache public/imagens-banners
chown -R www-data:www-data storage bootstrap/cache public/imagens-banners
chmod -R 775 storage bootstrap/cache public/imagens-banners

# Gerar APP_KEY se vazio
php artisan key:generate --force

# Executar migrations
php artisan migrate --force

# Criar link de storage
php artisan storage:link || true

# Executar seeders se banco vazio
COURSES_COUNT=$(php artisan tinker --execute="echo \App\Models\Course::count();" 2>/dev/null || echo "0")
if [ "$COURSES_COUNT" -eq "0" ]; then
    echo "🌱 Executando seeders..."
    php artisan db:seed --force
fi

# Cache otimizado
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Aplicação iniciada em http://localhost:8005"

# Iniciar Apache
apache2-foreground
