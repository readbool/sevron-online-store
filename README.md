# README
### REQUIREMENTS
- Docker
-----
### HOW TO RUN
- composer install
- php artisan sail:install
- ./vendor/bin/sail artisan migrate
- ./vendor/bin/sail artisan db:seed
- ./vendor/bin/sail up
---
ON POSTMAN

- login using credentials below.
- Add the returned token here
![Screenshot 2023-06-30 at 8.35.02 PM.png](..%2F..%2F..%2F..%2Fvar%2Ffolders%2F91%2F8rsxb79s1dqcrcvgcr1_wx2m0000gn%2FT%2FTemporaryItems%2FNSIRD_screencaptureui_819MzU%2FScreenshot%202023-06-30%20at%208.35.02%20PM.png)

- Add Header on POSTMAN
![Screenshot 2023-06-30 at 9.33.04 PM.png](..%2F..%2F..%2F..%2Fvar%2Ffolders%2F91%2F8rsxb79s1dqcrcvgcr1_wx2m0000gn%2FT%2FTemporaryItems%2FNSIRD_screencaptureui_91Sty8%2FScreenshot%202023-06-30%20at%209.33.04%20PM.png)
---
ROUTES

- run `./vendor/bin/sail artisan route:list` to see route lists and aliases.
---
Default Credentials

- User Admin
  - username: `admin@mail.com`
  - password: `password`
  
- User User
  - username: `user(random digit)@example.com` eg. user1@example.com
  - password: `password`
