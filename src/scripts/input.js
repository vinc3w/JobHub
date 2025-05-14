const inputContainers = Array.from(document.getElementsByClassName('input-container'));
const labels = Array.from(document.querySelectorAll('.input-label, .textarea-label'));
const inputs = Array.from(document.getElementsByClassName('input'));

const ignoreList = ['select', 'date'];

inputContainers.forEach((inputContainer, i) => {

	if (ignoreList.includes(inputs[i].getAttribute('type'))) {
		return;
	}

	inputs[i].onfocus = () => {
		labels[i].classList.contains('input-label') ?
			labels[i].classList.add('input-focus-label') :
			labels[i].classList.add('textarea-focus-label');
	}

	if (inputs[i].value) {
		inputs[i].onfocus();
	}

	inputContainer.onclick = () => inputs[i].focus();

	inputs[i].onblur = () => {
		if (!inputs[i].value) {
			labels[i].classList.contains('input-label') ?
				labels[i].classList.remove('input-focus-label') :
				labels[i].classList.remove('textarea-focus-label');
		}
	}

	if (inputs[i].type === 'password') {

		const showButton = inputs[i].nextElementSibling;
		showButton.onclick = () => {

			if (showButton.innerHTML.trim() === '<i class="fa-regular fa-eye"></i>') {
				showButton.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
				inputs[i].type = 'text';
			}
			else {
				showButton.innerHTML = '<i class="fa-regular fa-eye"></i>';
				inputs[i].type = 'password';
			}

			inputs[i].focus();

		}

	}
	
});
