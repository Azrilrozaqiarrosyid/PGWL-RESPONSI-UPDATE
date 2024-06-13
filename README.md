## PROJECT RESPONSI PRAKTIKUM PEMROGRAMAN GEOSPASIAL WEB: LANJUT
___
__CIVICTRACS (Civil Infrastructure Tracking and Monitoring System)__
___
## Deskripsi Project
___
CIVICTRACS merupakan website berbasis GIS yang dapat digunakan untuk melakukan pelaporan pada kerusakan penerangan jalan umum (PJU), jalan, serta bangunan milik pemerintah daerah. 
Website ini dibangun berdasarkan masih banyaknya kasus kerusakan 3 hal tersebut yang tidak kunjung ditangai serta kurang efektifnya jika tidak adanya suatu sistem yang mampu melakukan perekaman data secara kolektif. Melalui webgis ini, konsep yang ditawarkan adalah administrator melakukan pelaporan dengan mengisi formulir data serta melakukan tag untuk titik pelaporannya. hasil ini kemudian disimpan di database PostgreSQL yang kompilasi datanya dapat ditampilkan di WebGIS tersebut. Dari pengumpulan data tersebut, harapannya terdapat pengembangan lanjutan yang mana terdapat administrator utama yang dapat memantau hasil pelaporan dari administrator kecil yang mengisi form.
___
## Komponen Pembangun
___
Website ini dibangun oleh beberapa komponen:
1. Laravel PHP --> framework PHP yang dapat digunakan untuk mengembangkan web yang berisi banyak modul. Terdiri dari konsep model-view-controller.
2. HTML --> Bahasa pembangun utama untuk membangun sebuah Website
3. CSS --> Bahasa pendukung untuk style dari website yang dibangun dan mengatur tampilan elemen
4. PHP --> Bahasa pemrograman open-source yang dapat digunakan untuk membangun web menjadi lebih dinamis dan interaktif
5. JavaScript --> Secara tidak langsung juga membantu membangun website menjadi lebih dinamis dan interaktif
6. Boostrap --> Framework CSS untuk pengembangan front-end website
7. FontAwesome --> Library font icon berbasis CSS
8. DataTables --> Plugin JQuery untuk pengelolaan data dalam bentuk grid
9. Leaflet --> library untuk menampilkan webmap

Aplikasi Pendukung:
1. DBeaver --> Aplikasi untuk mengakses berbagai basis data dan melakukan monitoring hingga pengubahan database yang dipilih
2. PostgreSQL --> DBMS untuk melakukan pembuatan database dan penyimpanan data
3. Geoserver --> perangkat lunak mapserver yang open source ditulis di dalam bahasa pemrograman JAVA yang memungkinkan pengguna untuk berbagi dan mengedit data geospatial
4. QGIS --> Perangkat GIS open-source yang dapat digunakan untuk mengelola data spasial
5. PostGIS --> Ekstensi untuk menghubungkan postgreSQL dengan QGIS dalam hal penyambungan database spasial
6. Visual Studio Code --> Aplikasi code editor untuk pengembangan aplikasi/website
___
## Sumber data
___
1. Data partisipatif yang diambil dari sosial media seperti facebook dan instagram mengenai keluhan masyarakat tentang kasus yang diangkat
2. Data kolektif didapat dari data milik Pemerintah Kabupaten Lamongan, Dinas Pekerjaan Umum dan Bina Marga Kabupaten Lamongan, serta Dinas Perhubungan Kabupaten Lamongan
## Tangkapan layar komponen penting
___
_Halaman landing_
___
![Screenshot 2024-06-14 020309](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/2c1cc9fe-bba7-422e-8949-714ba3f5379a)
___
_Halaman Login_
___
![Screenshot 2024-06-14 020410](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/54dda7ff-eb1c-4411-988b-8390affbd169)
___
_Halaman dashboard_
___
![Screenshot 2024-06-14 020438](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/da241865-bc56-4590-b52f-a633fbe08150)
![Screenshot 2024-06-14 020505](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/cefbb075-c5c0-4501-ae97-d36cde58422e)
___
_Halaman webmap add data_
___
![Screenshot 2024-06-14 020541](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/cb1e38f2-e314-4212-8072-af577e49bc56)
___
_Halaman form input_
___
![Screenshot 2024-06-14 020627](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/512f4ce3-dc21-4846-a84b-54184e0e831e)
___
_Halaman edit data_
___
![Screenshot 2024-06-14 020657](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/b44bc448-2307-4c26-838d-e23629d1d1bc)
![Screenshot 2024-06-14 020739](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/3bda9b35-2304-4d9f-aaec-d12b4af02fa1)
___
_Halaman table data point_
___
![Screenshot 2024-06-14 020815](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/f482607c-eabe-4f02-8581-6ad3cfaf6408)
___
_Halaman table data polyline_
___
![Screenshot 2024-06-14 020852](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/ada48975-2ba3-42c9-a352-f4f8ee76ab98)
___
_Halaman table data polygon_
___
![Screenshot 2024-06-14 020921](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/76fd8c16-c8ec-40b6-91a2-dc8274db9713)
___
_Halaman Info_
___
![Screenshot 2024-06-14 020945](https://github.com/Azrilrozaqiarrosyid/PGWL-RESPONSI-UPDATE/assets/142295337/42e88e43-2a99-473b-a88b-9fb5cf842eea)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# PGWL-RESPONSI" 












