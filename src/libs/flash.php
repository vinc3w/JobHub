<?php

if (!isset($_SESSION[FLASH])) {
	$_SESSION[FLASH] = [];
}

function create_flash_message(string $name, string $message, string $type): void {
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];

}

function format_flash_message(array $flash_message): string {

    return sprintf(
		'
			<div class="fixed z-50 bottom-6 right-6 py-2 px-4 rounded text-lg alert-%s flex items-center">
				<button class="hover:opacity-80 active:opacity-70 transition-opacity" onclick="event.currentTarget.parentElement.remove()">
					<i class="fa-solid fa-circle-xmark text-sm"></i>
				</button>
				<div class="ml-3">%s</div>
			</div>
		',
		$flash_message['type'],
		$flash_message['message']
	);

}

function display_flash_message(string $name): void {

    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }
	
    $flash_message = $_SESSION[FLASH][$name];

    unset($_SESSION[FLASH][$name]);

    echo format_flash_message($flash_message);

}

function flash(string $name, string $message = '', string $type = FLASH_SUCCESS, bool $flash_now = false): void {
	
    if ($message !== '') {
        create_flash_message($name, $message, $type);
        if ($flash_now) {
            display_flash_message($name);
        }
		return;
    }

    display_flash_message($name);

}
