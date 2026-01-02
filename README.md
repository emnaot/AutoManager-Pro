# AutoManager Pro - Vehicle Management System

A comprehensive vehicle management system for automotive repair shops built with Laravel 10 and Vue.js 3. This modern web application provides complete CRUD operations, RESTful API, and an intuitive user interface for managing vehicle inventory.

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

## 🌟 Overview

AutoManager Pro is a full-stack web application designed for automotive repair shops to efficiently manage their vehicle inventory. The system combines the power of Laravel's robust backend with Vue.js's reactive frontend to deliver a seamless user experience.

### Key Highlights
- **Modern Architecture**: Built with Laravel 10 and Vue.js 3
- **RESTful API**: Complete API for external integrations
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile
- **Real-time Features**: Live search, filtering, and statistics
- **Professional UI**: Modern glassmorphism design with animations

## 🚀 Features

### 🔧 Core Functionality
- **Complete CRUD Operations**: Create, Read, Update, Delete vehicles
- **Advanced Search & Filtering**: Multi-criteria filtering system
- **Dual View Modes**: Switch between table and grid layouts
- **Real-time Statistics**: Live dashboard with vehicle metrics
- **Data Export**: CSV export functionality
- **Pagination**: Efficient handling of large datasets

### 🎨 User Interface
- **Modern Design**: Glassmorphism effects with gradients
- **Responsive Layout**: Mobile-first responsive design
- **Interactive Components**: Vue.js reactive components
- **Smooth Animations**: AOS (Animate On Scroll) integration
- **Intuitive Navigation**: User-friendly interface design

### 🔒 Security & Validation
- **CSRF Protection**: Built-in Laravel security features
- **Input Validation**: Server-side and client-side validation
- **SQL Injection Prevention**: Eloquent ORM protection
- **XSS Protection**: Blade template escaping
- **Error Handling**: Comprehensive error management

### 📊 Data Management
- **Database Migrations**: Version-controlled database schema
- **Data Seeding**: Sample data for testing and development
- **Relationship Management**: Proper database relationships
- **Data Integrity**: Validation rules and constraints

## 🛠️ Technology Stack

### Backend
- **Framework**: Laravel 10.x
- **Language**: PHP 8.1+
- **Database**: MySQL 8.0+
- **ORM**: Eloquent
- **API**: RESTful JSON API

### Frontend
- **Framework**: Vue.js 3.x
- **CSS Framework**: Bootstrap 5.3
- **Icons**: Font Awesome 6
- **Animations**: AOS Library
- **HTTP Client**: Axios

### Development Tools
- **Package Manager**: Composer (PHP), NPM (JavaScript)
- **Server**: Apache/Nginx (XAMPP recommended)
- **Version Control**: Git
- **IDE**: VS Code, PhpStorm

## 📋 System Requirements

### Minimum Requirements
- **PHP**: 8.1 or higher
- **MySQL**: 8.0 or higher
- **Apache/Nginx**: Web server
- **Composer**: PHP dependency manager
- **Memory**: 512MB RAM minimum
- **Storage**: 100MB free space

### Recommended Requirements
- **PHP**: 8.2+
- **MySQL**: 8.0+
- **Memory**: 1GB RAM
- **Storage**: 500MB free space
- **Node.js**: For asset compilation (optional)

## 🔧 Installation Guide

### Step 1: Clone the Repository
```bash
git clone https://github.com/emnaot/AutoManager-Pro.git
cd AutoManager-Pro
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Configuration
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=automanager_pro
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Database Setup
```bash
# Create database (if not exists)
mysql -u root -p -e "CREATE DATABASE automanager_pro;"

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### Step 6: Start Development Server
```bash
php artisan serve
```

Access the application at: `http://127.0.0.1:8000`

## 📊 Database Schema

### Vehicles Table
| Column | Type | Description | Constraints |
|--------|------|-------------|-------------|
| id | BIGINT | Primary key | AUTO_INCREMENT |
| immatriculation | VARCHAR(255) | Vehicle registration | UNIQUE, NOT NULL |
| marque | VARCHAR(255) | Vehicle brand | NOT NULL |
| modele | VARCHAR(255) | Vehicle model | NOT NULL |
| couleur | VARCHAR(255) | Vehicle color | NOT NULL |
| annee | INT | Manufacturing year | NOT NULL |
| kilometrage | INT | Current mileage | NOT NULL |
| carrosserie | VARCHAR(255) | Body type | NOT NULL |
| energie | VARCHAR(255) | Energy type | NOT NULL |
| boite | VARCHAR(255) | Transmission type | NOT NULL |
| created_at | TIMESTAMP | Creation date | AUTO |
| updated_at | TIMESTAMP | Last update | AUTO |

### Sample Data
The system includes sample data with:
- **5 vehicles** with different specifications
- **Multiple brands**: Peugeot, Renault, Toyota, Volkswagen, BMW
- **Various energy types**: Gasoline, Diesel, Hybrid, Electric
- **Different body types**: Sedan, Hatchback, SUV, Compact

## 🌐 API Documentation

### Base URL
```
http://127.0.0.1:8000/api
```

### Authentication
Currently, the API doesn't require authentication (suitable for internal use).

### Endpoints

#### Get All Vehicles
```http
GET /api/vehicules
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "immatriculation": "123TUN456",
      "marque": "Peugeot",
      "modele": "208",
      "couleur": "Blanc",
      "annee": 2020,
      "kilometrage": 45000,
      "carrosserie": "Berline",
      "energie": "Essence",
      "boite": "Manuelle",
      "created_at": "2024-01-01T10:00:00.000000Z",
      "updated_at": "2024-01-01T10:00:00.000000Z"
    }
  ],
  "message": "Véhicules récupérés avec succès"
}
```

#### Create Vehicle
```http
POST /api/vehicules
Content-Type: application/json
```

**Request Body:**
```json
{
  "immatriculation": "999TUN888",
  "marque": "Ford",
  "modele": "Focus",
  "couleur": "Blanc",
  "annee": 2023,
  "kilometrage": 5000,
  "carrosserie": "Berline",
  "energie": "Essence",
  "boite": "Manuelle"
}
```

#### Get Single Vehicle
```http
GET /api/vehicules/{id}
```

#### Update Vehicle
```http
PUT /api/vehicules/{id}
Content-Type: application/json
```

#### Delete Vehicle
```http
DELETE /api/vehicules/{id}
```

### Error Responses
```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field": ["Validation error message"]
  }
}
```

## 🎨 User Interface Guide

### Homepage (`/`)
- **Hero Section**: Welcome message with gradient background
- **Statistics Cards**: Real-time vehicle statistics
- **Feature Overview**: System capabilities showcase
- **Technology Stack**: Used technologies display

### Vehicle List (`/vehicules/liste`)
- **Statistics Dashboard**: Quick overview of vehicle data
- **Advanced Filters**: Search by registration, brand, energy, year, mileage
- **View Toggle**: Switch between table and grid views
- **Pagination**: Navigate through large datasets
- **Export Function**: Download data as CSV

### Add Vehicle (`/vehicules/create`)
- **Intuitive Form**: Step-by-step vehicle information input
- **Real-time Validation**: Instant feedback on form fields
- **Dropdown Selectors**: Pre-defined options for consistency
- **Error Handling**: Clear error messages and guidance

### Vehicle Details (`/vehicules/{id}/details`)
- **Comprehensive View**: All vehicle information displayed
- **Visual Indicators**: Progress bars for age and mileage
- **Color-coded Badges**: Energy types and colors
- **Quick Actions**: Edit, delete, and navigation buttons

### Edit Vehicle (`/vehicules/{id}/edit`)
- **Pre-filled Form**: Current vehicle data loaded
- **Validation**: Same validation rules as creation
- **Consistent UI**: Matches the add vehicle interface

## 🔍 Advanced Features

### Search and Filtering
- **Real-time Search**: Instant results as you type
- **Multi-criteria Filtering**: Combine multiple filters
- **Filter Reset**: Quick reset to default view
- **Result Counter**: Shows number of matching vehicles

### Data Visualization
- **Progress Bars**: Visual representation of vehicle age and mileage
- **Color-coded Badges**: Easy identification of energy types
- **Statistical Cards**: Key metrics at a glance
- **Responsive Charts**: Adapt to different screen sizes

### User Experience
- **Smooth Animations**: AOS library for scroll animations
- **Loading States**: Visual feedback during operations
- **Error Messages**: User-friendly error notifications
- **Success Confirmations**: Clear feedback on successful actions

## 🚀 Performance Optimizations

### Frontend Optimizations
- **Pagination**: Efficient data loading (10 items per page)
- **Client-side Filtering**: Instant filter responses
- **Lazy Loading**: Load resources on demand
- **Optimized CSS**: Minimal and efficient styling
- **Compressed Assets**: Reduced file sizes

### Backend Optimizations
- **Eloquent ORM**: Efficient database queries
- **Query Optimization**: Minimal database calls
- **Configuration Caching**: Laravel optimization features
- **Response Caching**: Cached API responses where appropriate
- **Error Logging**: Comprehensive error tracking

## 🧪 Testing

### Manual Testing
1. **CRUD Operations**: Test all create, read, update, delete functions
2. **Form Validation**: Test all validation rules
3. **API Endpoints**: Test all API routes with different data
4. **Responsive Design**: Test on different screen sizes
5. **Browser Compatibility**: Test on Chrome, Firefox, Safari, Edge

### API Testing with cURL
```bash
# Test GET all vehicles
curl -X GET http://127.0.0.1:8000/api/vehicules

# Test POST new vehicle
curl -X POST http://127.0.0.1:8000/api/vehicules \
  -H "Content-Type: application/json" \
  -d '{"immatriculation":"TEST123","marque":"Test","modele":"Model","couleur":"Red","annee":2023,"kilometrage":1000,"carrosserie":"Sedan","energie":"Gasoline","boite":"Manual"}'

# Test PUT update vehicle
curl -X PUT http://127.0.0.1:8000/api/vehicules/1 \
  -H "Content-Type: application/json" \
  -d '{"immatriculation":"UPDATED123","marque":"Updated","modele":"Model","couleur":"Blue","annee":2023,"kilometrage":2000,"carrosserie":"Sedan","energie":"Gasoline","boite":"Manual"}'

# Test DELETE vehicle
curl -X DELETE http://127.0.0.1:8000/api/vehicules/1
```

## 📱 Mobile Responsiveness

### Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### Mobile Features
- **Touch-friendly**: Large buttons and touch targets
- **Swipe Navigation**: Intuitive mobile navigation
- **Optimized Forms**: Mobile-friendly form inputs
- **Compressed Views**: Efficient use of screen space

## 🔧 Development Setup

### Local Development
```bash
# Clone repository
git clone https://github.com/emnaot/AutoManager-Pro.git
cd AutoManager-Pro

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve
```

### Code Structure
```
AutoManager-Pro/
├── app/
│   ├── Http/Controllers/
│   │   └── VehiculeController.php
│   └── Models/
│       └── Vehicule.php
├── database/
│   ├── migrations/
│   │   └── create_vehicules_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── VehiculeSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── vehicules/
│       │   ├── liste.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── web.php
│   └── api.php
├── public/
│   └── index.php
├── .env.example
├── composer.json
└── README.md
```

## 🤝 Contributing

We welcome contributions to AutoManager Pro! Here's how you can help:

### Getting Started
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Test thoroughly
5. Commit your changes (`git commit -m 'Add amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

### Contribution Guidelines
- Follow PSR-12 coding standards for PHP
- Write clear, descriptive commit messages
- Include tests for new features
- Update documentation as needed
- Ensure backward compatibility

## 🐛 Troubleshooting

### Common Issues

#### 1. Composer Install Fails
```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Install with verbose output
composer install -v
```

#### 2. Database Connection Error
- Check MySQL service is running
- Verify database credentials in `.env`
- Ensure database exists
- Check MySQL port (default: 3306)

#### 3. Permission Errors
```bash
# Fix Laravel permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

#### 4. Key Generation Error
```bash
# Generate new application key
php artisan key:generate --force
```

#### 5. Migration Errors
```bash
# Reset and re-run migrations
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### MIT License Summary
- ✅ Commercial use
- ✅ Modification
- ✅ Distribution
- ✅ Private use
- ❌ Liability
- ❌ Warranty

## 🙏 Acknowledgments

### Technologies Used
- **[Laravel](https://laravel.com/)** - The PHP Framework for Web Artisans
- **[Vue.js](https://vuejs.org/)** - The Progressive JavaScript Framework
- **[Bootstrap](https://getbootstrap.com/)** - Build fast, responsive sites
- **[Font Awesome](https://fontawesome.com/)** - The world's most popular icon set
- **[AOS](https://michalsnik.github.io/aos/)** - Animate On Scroll Library

### Inspiration
- Modern web application design principles
- Automotive industry management needs
- User experience best practices
- RESTful API design standards

## 📞 Support

### Getting Help
- **Issues**: [GitHub Issues](https://github.com/emnaot/AutoManager-Pro/issues)
- **Discussions**: [GitHub Discussions](https://github.com/emnaot/AutoManager-Pro/discussions)
- **Documentation**: This README and inline code comments

### Reporting Bugs
When reporting bugs, please include:
1. **Environment**: OS, PHP version, MySQL version
2. **Steps to reproduce**: Detailed steps
3. **Expected behavior**: What should happen
4. **Actual behavior**: What actually happens
5. **Screenshots**: If applicable

### Feature Requests
We welcome feature requests! Please:
1. Check existing issues first
2. Describe the feature clearly
3. Explain the use case
4. Consider implementation complexity

---

**AutoManager Pro** - Professional Vehicle Management System for Modern Automotive Businesses

*Built with ❤️ using Laravel and Vue.js*
