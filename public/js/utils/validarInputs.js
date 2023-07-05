 function validarInputs() {
  const inputsTexts = $$("input[type='text']")
  inputsTexts.forEach(element => {
    element.addEventListener('keypress', (e) => {

      const charCode = e.which || e.keyCode;
      const char = String.fromCharCode(charCode);
      const pattern = /[a-zA-Z\s]/;

      if (!pattern.test(char)) {
        e.preventDefault();
      }
    })

    element.addEventListener('input', function () {
      const maxLength = 45; // Define la longitud máxima permitida
      console.log('holas')
      if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength); // Limita la longitud del valor
      }
    });
  });
}