import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



document.getElementById('primary_muscles').addEventListener('change', function() {
  // Obtener las opciones seleccionadas
  const selectedOptions = Array.from(this.selectedOptions).map(option => option.text);

  document.getElementById('primary_muscles_selected').textContent = selectedOptions.join(', ')
});

document.getElementById('secondary_muscles').addEventListener('change', function() {
  // Obtener las opciones seleccionadas
  const selectedOptions = Array.from(this.selectedOptions).map(option => option.text);

  document.getElementById('secondary_muscles_selected').textContent = selectedOptions.join(', ')
});