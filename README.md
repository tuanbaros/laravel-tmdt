# laravel-tmdt
project for android samsung class

+ Yêu cầu môi trường chạy project
	- php phiên bản thấp nhất là 5.6
	- có hệ cơ sở dữ liệu mysql hoặc pgsql

+ Hiện tại ứng dụng đang cấu hình sử dụng môi trường database là localhost với hệ cơ sở dữ liệu là mysql. Để thay đổi môi trường database, bạn chọn file .env và thay đổi như sau
	DB_CONNECTION=mysql	=>		DB_CONNECTION=hệ cơ sở dữ liệu của bạn
	DB_HOST=127.0.0.1	=>		DB_HOST=host cơ sở dữ liệu của bạn
	DB_PORT=3306		=>		DB_PORT=cổng port
	DB_DATABASE=bookstore	=>		DB_DATABASE=tên cơ sở dữ liệu
	DB_USERNAME=root	=>		DB_USERNAME= tên đăng nhập
	DB_PASSWORD=		=>		DB_PASSWORD= mật khẩu đăng nhập

+ Chạy project: (hướng dẫn trên môi trường localhost)	
	- Lây địa chỉ ip của máy
	- Bật terminal hoặc cmd vào thư mục laravel-tmdt
	- Gõ lệnh: php artisan serve --host=địa chỉ ip của bạn (ví dụ; 192.168.0.8)
	- Kết quả như sau là thành công: Laravel development server started on http://192.168.0.8:8000/
	- Vào browser với đường dẫn: http://192.168.0.8:8000/
	- Tài khoản admin: admin - admin
