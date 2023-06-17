# NEW NORMAL FASHIN CI 4

## Instalasi

1. buka terminal di folder projek dan jalankan composer
    ```bash
    composer update
    ```
2. copy file env  lalu rename menjadi file `.env`
3. ubah konfigurasi database pada file `.env`
4. jalankan perintah 
    ```bash
    php spark migrate
    ```
    lalu
    ```bash
    php spark db:seed DatabaseSeeder
    ```
    atau
    ```
    Buat nama database `newnormal_ci4` kemudian hapus file table `admin` dan import file `admin.sql`
    ```

5. jalankan dengan perintah
    ```bash
    php spark serve
    ```
    kemudian buka urlnya `http://localhost:8080/`
 - Akun untuk login admin :
    - Username : admin
    - Password : admin
  - Akun untuk login user :
    - Silahkan Daftar terlebih dahulu 