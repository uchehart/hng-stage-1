# Number Classification API

A Laravel-based REST API that analyzes numbers and returns their mathematical properties along with interesting facts.

## Features

- Number classification and analysis
- Mathematical properties detection (prime, perfect, Armstrong)
- Integration with Numbers API for fun mathematical facts
- CORS support
- Input validation and error handling
- JSON response format

## Requirements

- PHP >= 8.1
- Composer
- Laravel 10.x
- HTTP client for external API calls

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/number-classifier-api.git
cd number-classifier-api
```

2. Install dependencies:
```bash
composer install
```

3. Copy the environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

## API Documentation

### Endpoint

```
GET /api/classify-number
```

### Query Parameters

- `number` (required): Integer to be analyzed

### Success Response (200 OK)

```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

### Error Response (400 Bad Request)

```json
{
    "number": "invalid_input",
    "error": true
}
```

## Features Explained

1. **Prime Number Detection**: Checks if the number is prime using efficient algorithm
2. **Perfect Number Detection**: Verifies if sum of proper divisors equals the number
3. **Armstrong Number**: Validates if sum of digits raised to power of number of digits equals the number
4. **Properties Array**: Includes combinations of:
   - ["armstrong", "odd"]
   - ["armstrong", "even"]
   - ["odd"]
   - ["even"]
5. **Digit Sum**: Calculates sum of all digits in the number
6. **Fun Fact**: Retrieves interesting mathematical fact from Numbers API

## Deployment

1. Configure your web server (Apache/Nginx) to point to the `public` directory
2. Update CORS settings in `config/cors.php` for production
3. Set appropriate environment variables in `.env`
4. Ensure proper error handling and logging is configured

## Running Tests

```bash
php artisan test
```

## Error Handling

The API implements comprehensive error handling:
- Input validation for non-numeric values
- HTTP status codes for different scenarios
- Fallback for external API failures

## Performance

- Response time < 500ms
- Efficient algorithms for mathematical calculations
- Proper error handling and validation

## Security

- Input sanitization
- CORS configuration
- Rate limiting (recommended for production)

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

MIT License - feel free to use and modify for your purposes.
