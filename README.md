# TG-AutoProfiler by @wiz64
PHP Script to change your name, bio, profile picture automatically on cron/Http Request. Rice up your Telegram Profile.

> Status: `Active`
# Details
> Developer : [wiz64](https://github.com/wiz64)<br>
> Repo: [Github](https://github.com/wiz64/tg-autoprofiler)
<!-- picture -->
<img src="https://user-images.githubusercontent.com/67432394/199704649-1f1a70a2-8c55-4cb1-8079-e40cfe00523e.png" width="300px">

- Write Time/Date at middle of your profile pic
- Update Telegram Profile Picture every hour out of chosen pics 😎
- Update Randomly Selected Name & Bio
- Fake last seen time
- Do More Automated Stuff !
- Runs over cli & Webserver both

### CAUTION !!!
Note - Use at your own risk
> This Script is safe to use as long you use don't abuse it<br>
Also keep the hosting url to you only. KEEP `sessions` folder inaccessible to open internet.

## INSTALLATION
Requirements :
- `PHP 7.2+ Web-Server/Web Hosting`
- `php-gd, php-mbstring, php-xml` - extensions 
Note- You can easily host this script on any PHP Webserver. Tested on php7.4 on Replit
### Web/FTP
- Download this repository as a zip file. extract it to your webserver.
- Upload your profile photos to pictures folder, any .jpg file will be chosen at random. Replace `font.ttf` for custom font.
- Change bio/name/settings by editing [config.json](config.json)
- You can edit format inside [index.php](index.php)
- Visit index.php through a web browser, login for API ID/Hash and then again as `User` (not bot) for session access, and test the script
- Use [cron-job.org](https://cron-job.org/en/) to setup a hourly/daily cron

### CLI
 - Clone the repository / Download zip and extract it
 - Configure as in Web
 - run <br>
 `php index.php` <br>
 to login twice and test script
 - Setup Cron job using crontab. Run
 - `crontab -e` <br>
 and then add the php script
 - `0 * * * * php /path/to/index.php` <br><br>
 Note -  `0 * * * *` means hourly here.<br>
 [crontab.guru](https://crontab.guru/)

## Todo 
- Impliment token - for security

Credits - [wiz64](https://github.com/wiz64)
---
Sponsor/Donate me to support the development of this and many other projects I maintain.
### Images
<p><img src="https://user-images.githubusercontent.com/67432394/199704588-e8682dee-2450-4e95-bf63-16274f4a6989.png" width="300px">
<img src="https://user-images.githubusercontent.com/67432394/199704749-42987753-0c63-4b64-936d-acf1eb17bce1.png" width="300px"></p>
