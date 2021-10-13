$(document).ready(function() {
    $('select').formSelect()
    $('.sidenav').sidenav()
    webshims.setOptions('forms-ext', {
        types: 'datetime-local'
    });
    webshims.polyfill('forms forms-ext');
})