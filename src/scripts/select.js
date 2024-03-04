const selects = Array.from(document.getElementsByClassName('select'));
const selectButtons = Array.from(document.getElementsByClassName('select-button'));

selects.forEach((select, i) => {

	const menu = select.nextElementSibling;
	
	select.onclick = e => {

		e.stopPropagation();

		if (menu.style.display === 'none') {
			menu.style.display = '';
			selectButtons[i].children[0].style.transform = 'rotate(180deg)';
		}
		else {
			menu.style.display = 'none';
			selectButtons[i].children[0].style.transform = '';
		}

		const hideMenu = () => {
			menu.style.display = 'none';
			selectButtons[i].children[0].style.transform = '';
			document.body.removeEventListener('click', hideMenu);
		}

		document.body.addEventListener('click', hideMenu);

	}

	menu.onclick = (e) => {

		e.stopPropagation();

	}

	const menuItems = Array.from(menu.children)
	menuItems.forEach(child => {

		const selectInput = select.querySelector('.select-input');
		const placeholder = select.querySelector('.placeholder');
		const checkbox = child.querySelector('input[type=checkbox]');

		if (checkbox) {
			checkbox.onclick = e  => {
				e?.stopPropagation();
				let checkCount = 0;
				let checkedValue;
				menuItems.forEach(item => {
					const checkbox = item.querySelector('input[type=checkbox]');
					checkCount += checkbox.checked ? 1 : 0;
					checkedValue = checkbox.checked ? checkbox.value : checkedValue;
				});
				if (!checkCount) {
					placeholder.innerText = 'None';
				}
				else {
					placeholder.innerText = checkCount === 1 ? checkedValue : checkCount + ' selected';
				}
			}
			child.onclick = () => {
				checkbox.checked = !checkbox.checked;
				checkbox.onclick();
			}
		} else {
			child.onclick = () => {
				selectInput.value = child.getAttribute('value');
				menu.style.display = 'none';
				document.body.onclick = null;
				placeholder.innerText = child.getAttribute('name');
			}
		}

		

	})

});
