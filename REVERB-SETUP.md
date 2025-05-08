# Laravel Reverb Setup Guide

This project uses Laravel Reverb for real-time messaging instead of Pusher. Here's how to set it up:

## Installation

1. First, install Laravel Reverb:

```bash
composer require laravel/reverb
```

2. Build the Reverb JavaScript client assets:

```bash
php artisan reverb:install
```

3. Add the following environment variables to your `.env` file:

```
# Set the broadcast driver to Reverb
BROADCAST_DRIVER=reverb

# Reverb Configuration
REVERB_APP_ID=app-id
REVERB_APP_KEY=app-key
REVERB_APP_SECRET=app-secret
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http
```

4. Install the frontend dependencies:

```bash
npm install
```

## Running Reverb Server

Start the Reverb server:

```bash
php artisan reverb:start
```

In production, you might want to use a process manager like Supervisor to keep Reverb running.

## Development Setup

1. Open one terminal window and start Reverb:

```bash
php artisan reverb:start
```

2. Open another terminal window and start your Laravel development server:

```bash
php artisan serve
```

3. In a third terminal window, compile your assets:

```bash
npm run dev
```

## Troubleshooting

If you encounter issues:

1. Check that Reverb is running with:

```bash
php artisan reverb:status
```

2. Make sure your `.env` file has the correct Reverb configuration.

3. Verify that the browser console doesn't show any connection errors.

4. You can check the Reverb logs in `storage/logs/reverb.log`.

## Using a Custom Configuration

This project includes a `reverb.yaml` file with a custom configuration. You can use it by running:

```bash
php artisan reverb:start --config=reverb.yaml
```
