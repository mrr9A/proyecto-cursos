 function validarInputs() {
  const inputsTexts = $$("input[type='text']")
  inputsTexts.forEach(element => {
    element.addEventListener('keypress', (e) => {

      const charCode = e.which || e.keyCode;
      const char = String.fromCharCode(charCode);
      let pattern = /[a-zA-Z\s]/;
      if(e.target.id === 'codigo'){
        pattern = /[a-zA-Z0-9\s\-]/
      }
      if (!pattern.test(char)) {
        e.preventDefault();
      }
    })

    element.addEventListener('input', function (e) {
      let maxLength = 45; // Define la longitud máxima permitida
      if(e.target.id === 'codigo'){
        maxLength = 12
      }
      if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength); // Limita la longitud del valor
      }
    });
  });

}