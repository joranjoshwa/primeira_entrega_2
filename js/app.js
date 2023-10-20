function fechar()
{
    let elemento = document.getElementsByClassName('error')[0];
    elemento.classList.remove('error');
    elemento.classList.add('fechar');
}