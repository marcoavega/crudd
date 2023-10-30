document.addEventListener('DOMContentLoaded', () => {
  // Este evento se dispara cuando el contenido del DOM (Document Object Model) ha sido cargado y está listo para ser manipulado.

  // Obtiene todos los elementos con la clase "navbar-burger" y los convierte en un array.
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Agrega un evento de clic a cada uno de los elementos "navbar-burger".
  $navbarBurgers.forEach(el => {
    el.addEventListener('click', () => {
      // Cuando se hace clic en un "navbar-burger":

      // Obtiene el valor del atributo "data-target".
      const target = el.dataset.target;

      // Busca el elemento HTML con el ID correspondiente al valor del atributo "data-target".
      const $target = document.getElementById(target);

      // Alterna la clase "is-active" en tanto el "navbar-burger" como el "navbar-menu".
      el.classList.toggle('is-active');
      $target.classList.toggle('is-active');
    });
  });
});
