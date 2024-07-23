ARG PLATFORM="linux/amd64"

FROM --platform=${PLATFORM} ghcr.io/distroless-php/image:8.3-base AS base

RUN cd "/build/php-src/ext" \
 &&   cd "pdo_mysql" \
 &&     phpize && ./configure && make -j"$(nproc)" && make install \
 &&   cd - \
 &&   cd "pdo_pgsql" \
 &&     apt-get update && apt-get install -y "postgresql-server-dev-all" \
 &&     phpize && ./configure && make -j"$(nproc)" && make install \
 &&   cd - \
 && cd -

COPY "./third_party/redis" "/build/redis"
RUN cd "/build/redis" \
 &&   phpize && ./configure && make -j"$(nproc)" && make install \
 && cd -

RUN distroless_php_add_binary $(find "$(php-config --extension-dir)" -type f -name "*.so")

FROM --platform=${PLATFORM} ghcr.io/distroless-php/image:8.3-cli

COPY --from=base "/rootfs" "/"

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY "./cli/usr" "/usr"
