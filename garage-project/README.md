# AutoManager Pro

A modern vehicle management system for automotive repair shops built with Laravel and Vue.js.

![AutoManager Pro](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)

## 🚀 Features

### Core Functionality
- **Complete CRUD Operations** - Create, Read, Update, Delete vehicles
- **RESTful API** - Full REST API with JSON responses
- **Modern UI/UX** - Responsive design with Vue.js components
- **Advanced Filtering** - Search by registration, brand, energy type, year, and mileage
- **Dual View Modes** - Table and grid view for vehicle listings
- **Real-time Statistics** - Dashboard with live vehicle statistics

### Technical Features
- **Laravel 10** - Modern PHP framework with MVC architecture
- **Vue.js 3** - Reactive frontend components
- **Bootstrap 5** - Responsive CSS framework
- **MySQL Database** - Robust data storage with migrations
- **Data Validation** - Server-side and client-side validation
- **CSRF Protection** - Built-in security features
- **Database Seeding** - Sample data for testing

## 🛠️ Technology Stack

- **Backend**: Laravel 10 (PHP 8.1+)
- **Frontend**: Vue.js 3, Bootstrap 5
- **Database**: MySQL 8.0+
- **Server**: Apache (XAMPP)
- **Package Manager**: Composer
- **Icons**: Font Awesome 6
- **Animations**: AOS (Animate On Scroll)

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Apache/Nginx web server
- Node.js (optional, for asset compilation)

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/emnaot/AutoManager-Pro.git
cd AutoManager-Pro
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Configure your database connection in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=automanager_pro
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Start the Development Server
```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`

## 📊 Database Schema

### Vehicles Table Structure
| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key (auto-increment) |
| immatriculation | string | Unique vehicle registration number |
| marque | string | Vehicle brand |
| modele | string | Vehicle model |
| couleur | string | Vehicle color |
| annee | integer | Manufacturing year |
| kilometrage | integer | Current mileage |
| carrosserie | string | Body type |
| energie | string | Energy type (Gasoline, Diesel, Electric, Hybrid) |
| boite | string | Transmission type |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

## 🌐 API Endpoints

### Vehicle Management
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/vehicules` | List all vehicles |
| POST | `/api/vehicules` | Create a new vehicle |
| GET | `/api/vehicules/{id}` | Get specific vehicle |
| PUT | `/api/vehicules/{id}` | Update vehicle |
| DELETE | `/api/vehicules/{id}` | Delete vehicle |

### Web Routes
| Route | Description |
|-------|-------------|
| `/` | Homepage |
| `/vehicules/liste` | Vehicle list (table/grid view) |
| `/vehicules/create` | Add new vehicle form |
| `/vehicules/{id}/details` | Vehicle details page |
| `/vehicules/{id}/edit` | Edit vehicle form |

## 🎨 User Interface

### Homepage
- Modern hero section with gradients
- Real-time statistics dashboard
- Feature overview cards
- Technology stack showcase

### Vehicle Management
- **List View**: Comprehensive table with sorting and filtering
- **Grid View**: Card-based layout for visual browsing
- **Advanced Filters**: Search by multiple criteria
- **Pagination**: Efficient data loading
- **Export**: CSV export functionality

### Forms
- **Add Vehicle**: Intuitive form with validation
- **Edit Vehicle**: Pre-populated form for updates
- **Real-time Validation**: Instant feedback on form inputs
- **Error Handling**: User-friendly error messages

## 🔒 Security Features

- **CSRF Protection**: Built-in Laravel CSRF tokens
- **Input Validation**: Server-side and client-side validation
- **SQL Injection Prevention**: Eloquent ORM protection
- **XSS Protection**: Blade template escaping
- **Data Sanitization**: Clean user inputs

## 🚀 Performance Optimizations

### Frontend
- **Pagination**: Efficient data loading
- **Client-side Filtering**: Responsive user interactions
- **Optimized CSS**: Minimal and efficient styling
- **Lazy Loading**: On-demand resource loading

### Backend
- **Optimized Queries**: Efficient database operations
- **Configuration Caching**: Laravel optimization
- **Structured Responses**: Clean JSON API responses
- **Error Logging**: Comprehensive error tracking

## 📱 Responsive Design

- **Mobile-First**: Optimized for mobile devices
- **Tablet Support**: Adapted layouts for tablets
- **Desktop**: Full-featured desktop experience
- **Cross-Browser**: Compatible with modern browsers

## 🧪 Testing

### Sample Data
The application includes a seeder with sample vehicles:
- Various brands (Peugeot, Renault, Toyota, Volkswagen, BMW)
- Different energy types (Gasoline, Diesel, Hybrid, Electric)
- Multiple body types and transmission options

### API Testing
Test the API endpoints using tools like:
- **Postman**: Complete API testing suite
- **Thunder Client**: VS Code extension
- **cURL**: Command-line testing

Example API calls:
```bash
# Get all vehicles
curl -X GET http://127.0.0.1:8000/api/vehicules

# Create a new vehicle
curl -X POST http://127.0.0.1:8000/api/vehicules \
  -H "Content-Type: application/json" \
  -d '{
    "immatriculation": "123ABC456",
    "marque": "Toyota",
    "modele": "Camry",
    "couleur": "White",
    "annee": 2023,
    "kilometrage": 5000,
    "carrosserie": "Sedan",
    "energie": "Hybrid",
    "boite": "Automatic"
  }'
```

## 🔄 Development Workflow

### Code Structure
```
app/
├── Http/Controllers/
│   └── VehiculeController.php    # Main controller
├── Models/
│   └── Vehicule.php              # Vehicle model
database/
├── migrations/                   # Database migrations
└── seeders/                     # Sample data seeders
resources/
├── views/                       # Blade templates
│   ├── layouts/app.blade.php    # Main layout
│   └── vehicules/               # Vehicle views
routes/
├── web.php                      # Web routes
└── api.php                      # API routes
```

### Best Practices
- **MVC Architecture**: Clean separation of concerns
- **RESTful Design**: Standard API conventions
- **Validation**: Comprehensive input validation
- **Error Handling**: Graceful error management
- **Code Documentation**: Clear and concise comments

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/emnaot/AutoManager-Pro/issues) page
2. Create a new issue with detailed information
3. Include steps to reproduce any bugs

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing PHP framework
- **Vue.js Team** - For the reactive frontend framework
- **Bootstrap Team** - For the responsive CSS framework
- **Font Awesome** - For the beautiful icons
- **AOS Library** - For smooth animations

---

**AutoManager Pro** - Modern Vehicle Management System