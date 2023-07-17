function correccionModal() {
  const btnModals = $$(".boton_modal")

  btnModals.forEach(btn => {
    btn.addEventListener('click', e => {
      // ejecuta este evento al final despues de ejecutar todos los demas gracias al eventloop
      setTimeout(() => {
        // obtenemos los div que tienen la clase inset-0 que nos causa error
        var divs = document.querySelectorAll('div[modal-backdrop]');

        divs.forEach(e => {
          // eliminamos la clase inset-0 de todos los divs obtenidos
          e.classList.remove('inset-0')
        })

      }, 0);
    });
  });
}
