<div align="center">
    <img width="400" src="https://user-images.githubusercontent.com/35447073/204126195-4c4d3054-1cdf-42cf-bae2-fb24dca6343c.png">
</div>

[![DigitalOcean Referral Badge](https://web-platforms.sfo2.digitaloceanspaces.com/WWW/Badge%202.svg)](https://www.digitalocean.com/?refcode=fa7650c51f2d&utm_campaign=Referral_Invite&utm_medium=Referral_Program&utm_source=badge)

## Requirements

Install the following dev tools before getting started:

- [Node JS](https://nodejs.org)
- [Composer](https://getcomposer.org)
- [Laragon](https://laragon.org) or [Xampp](https://www.apachefriends.org/) 

## Get Started
1. Clone the repository to the web server of your choice. Make sure that it is running Apache and MySQL.
    - *Note: Laragon is the **www** folder and Xampp is the **htdocs** folder.*
2. Rename the `.env.example` file to `.env` only.
3. Open the terminal then change your directory to the project folder.
4. Run `composer install` then `composer update`.
5. Run `npm install`.
6. Open a web browser and go to `localhost/phpmyadmin` and create a database named `catering-system`.
7. Go back to your terminal and run `php artisan migrate:fresh --seed`.
8. Lastly, run `php artisan serve` and you are good to go.
