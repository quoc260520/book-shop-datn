# Sử dụng image cơ bản của Nginx
FROM nginx:latest

# Xóa cấu hình mặc định của Nginx
RUN rm /etc/nginx/conf.d/default.conf

# Sao chép tệp tin cấu hình Nginx tùy chỉnh vào container
COPY ./nginx/conf.d/ /etc/nginx/conf.d/

# Sao chép mã nguồn Laravel vào thư mục gốc của Nginx
COPY . /var/www/html

# Thiết lập quyền cho các tệp tin và thư mục trong Laravel
RUN chown -R nginx:nginx /var/www/html

# Expose cổng 80 để truy cập ứng dụng Laravel
EXPOSE 80
