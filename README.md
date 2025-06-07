<p align="center"><img src="./public/lacaktanah_full.png" height="100" alt="LacakTanah Logo"></p>

## About LacakTanah

LacakTanah is a comprehensive land tracking and registry management system built with Laravel. The application helps track land ownership, transactions, and documentation, making property management efficient and transparent.

## Key Features

- Land property registration and tracking
- Ownership history and documentation
- Transaction management and verification
- Digital document storage and retrieval
- User role management (admin, staff, public users)
- Reporting and analytics
- Interactive maps integration

## Installation

```bash
# Clone the repository
git clone https://github.com/AvavSam/LacakTanah.git

# Navigate to the project directory
cd LacakTanah

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed

# Start the development server
php artisan serve
```

## System Requirements

- PHP >= 8.2
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

## Technologies Used

- Laravel 12.x
- MySQL
- Blade (Frontend)
- Tailwind CSS

## Usage

1. Navigate to `http://localhost:8000` in your web browser
2. Login with your credentials
3. Access the dashboard to view land statistics and map
4. Use the "Lands" section to manage land parcels
5. Monitor document expiry dates through the expiring documents view

## Directory Structure

- `app/` - Contains the core code of the application
  - `Http/Controllers/` - Application controllers
  - `Http/Requests/` - Form validation requests
  - `Models/` - Database models
- `database/` - Database migrations and seeders
- `resources/` - Views, assets, and language files
- `storage/` - Application storage (uploads, logs, etc.)
- `routes/` - Application routes
- `public/` - Publicly accessible files

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

- Laravel - The web framework used
- Tailwind CSS - For styling
- Leaflet.js - For map visualization
- Microsoft Azure - For document storage
