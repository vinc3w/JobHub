const container = document.getElementById('skill-container');
const addButton = document.getElementById('add-skill-button');

Array.from(container.children).forEach(skill => {

	const deleteButton = skill.querySelector(`.danger-button`);
	deleteButton.onclick = () => skill.remove();

});

addButton.onclick = () => {

	const skillElement = document.createElement('div');
	skillElement.classList.add('flex');
	skillElement.innerHTML = /*html*/`
		<div class="w-full">
			<div class="input-container relative">
				<div class="input-label">Skill</div>
				<input type="text" class="input w-full" id="skills[]" name="skills[]">
			</div>
			<div class="text-red-500"></div>
		</div>	
		<button class="danger-button ml-4" type="button">
			<i class="fa-solid fa-trash"></i>
		</button>
	`;

	const inputContainer = skillElement.querySelector('.input-container');
	const input = skillElement.querySelector('.input');
	const label = skillElement.querySelector('.input-label');

	input.onfocus = () => label.classList.add('input-focus-label');

	inputContainer.onclick = () => input.focus()

	input.onblur = () => {
		if (!input.value) {
			label.classList.remove('input-focus-label');
		}
	}

	const deleteButton = skillElement.querySelector(`.danger-button`);
	deleteButton.onclick = () => skillElement.remove();

	container.insertAdjacentElement('beforeend', skillElement);

}
