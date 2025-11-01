# Khadmati

## Setup

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/DBawazir2002/khadmati.git
   cd project

2. **Install PHP dependencies:**
   ```bash
   composer i

3. **Environment setup:**
   ```bash
    cp .env.example .env
    php artisan key:generate
    ```
   Edit .env file with your:
   Database credentials (DB_* variables)
   App URL (APP_URL)

4. **Database setup:**
    ```bash
   php artisan migrate --seed
    ```

5. **Storage link**
    ```bash
   php artisan storage:link
    ```

*To Access The API Docs:* 

```(APP_URL) . docs/api``` 

example: 
```bash 
127.0.0.1:8000/docs/api
```

*Default Credentials For Access Dashboard:*
1. *phone: ```777777777```*
2. *password: ```password```*
