# Instructions

1. Install PHP 7.4.20 (ppa:ondrej/php), PHP GD, PHP XML, Composer and Ghostscript

    sudo apt get install php7.4 php7.4-gd php7.4-xml composer ghostscript

2. Do composer update

3. Install Garamond (https://stackoverflow.com/a/45977159) font with 

    php load_font.php Garamond fonts/GARA.TTF

4. Run script in cli and check output.pdf

    php create_pdf.php