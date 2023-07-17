function correccionModal() {
  const btnModals = $$(".boton_modal")

  btnModals.forEach(btn => {
    btn.addEventListener('click', e => {
      setTimeout(() => {
        var divs = document.querySelectorAll('div[modal-backdrop]');
        console.log(divs, 'asdasdas');

        divs.forEach(e => {
          console.log(e)
          e.classList.remove('inset-0')
        })

      }, 0);
    });
  });
}
