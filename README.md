# Laravel Delivery System

## Description

This Laravel project implements a delivery assignment system where orders are automatically assigned to delivery boys based on their availability and order capacity.

## Prerequisites

- PHP 7.3 or higher
- Composer
- Laravel 8.x

## Setup Instructions

Follow these steps to set up and run the Laravel Delivery System:


1. **Install**

   Clone the repository to your local machine:
   ```bash
   git clone https://github.com/ashuwebmaster/deliveryboytask.git
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=DeliveryBoysSeeder
   php artisan db:seed --class=OrderSeeder


2 . **Run the command to assign unassigned orders to available delivery boys:**

    php artisan assign:orders
