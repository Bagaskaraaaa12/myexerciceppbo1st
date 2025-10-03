# Gunakan official PHP image dengan Apache
FROM php:8.2-apache

# Salin file PHP ke direktori web
COPY index.php /var/www/html/
COPY home.php /var/www/html/
COPY latihan1.php /var/www/html/
COPY latihan2.php /var/www/html/
COPY latihan3.php /var/www/html/
COPY tugasmandiri.php /var/www/html/
COPY objeksegitiga.php /var/www/html/
COPY classsegitiga.php /var/www/html/
COPY latihanobjek.php /var/www/html/
COPY enkapsulasi.php /var/www/html/
COPY this.php /var/www/html/
COPY praktikum51.php /var/www/html/
COPY praktikum52.php /var/www/html/
COPY praktikum6.php /var/www/html/
COPY praktikum7 /var/www/html/praktikum7

# Ubah DocumentRoot ke praktikum7
RUN sed -i 's#/var/www/html#/var/www/html/praktikum7#g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's#/var/www/html#/var/www/html/praktikum7#g' /etc/apache2/apache2.conf

# Expose port 7860
EXPOSE 7860

# Ganti port Apache ke 7860
RUN sed -i 's/80/7860/g' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf

CMD ["apache2-foreground"]
