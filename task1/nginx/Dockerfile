
FROM nginx:alpine

# Remove default config and copy our own Nginx configuration
RUN rm /etc/nginx/conf.d/default.conf
COPY default.conf /etc/nginx/conf.d/

# Expose port 80
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]

