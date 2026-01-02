#!/bin/bash

echo "🚀 AutoManager Pro - Quick Deploy Script"
echo "========================================"

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.1+ first."
    exit 1
fi

echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "🔑 Generating application key..."
php artisan key:generate

echo "📊 Running database migrations..."
php artisan migrate --force

echo "🌱 Seeding database with sample data..."
php artisan db:seed --force

echo "🗂️ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"
echo "🌐 You can now access AutoManager Pro at: http://127.0.0.1:8000"
echo ""
echo "To start the development server, run:"
echo "php artisan serve"