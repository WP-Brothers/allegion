const inputs = (input: HTMLInputElement) => {
  const checkInputValue = () => {
    if (input.value.trim() !== '') {
      input.setAttribute('data-hasvalue', 'true');
    } else {
      input.removeAttribute('data-hasvalue');
    }
  };

  checkInputValue();
  input.addEventListener('input', checkInputValue);
}

export default inputs;
