<?php

function view(string $filename, array $data = []): void {

    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require __DIR__ . '/../../inc/' . $filename . '.php';

}

function is_post_request(): bool {

	return $_SERVER['REQUEST_METHOD'] === 'POST';

}

function is_get_request(): bool {

	return $_SERVER['REQUEST_METHOD'] === 'GET';

}

function redirect_to(string $url) {

    header('Location:' . $url);
    exit;

}

function redirect_with_message(string $url, string $name, string $message, string $type = FLASH_SUCCESS) {

    flash($name, $message, $type);
    redirect_to($url);

}

function refresh() {

    header("Refresh:0");

}

function add_to_url_params(array $data): string {

    return http_build_query(array_merge($_GET, $data));

}
